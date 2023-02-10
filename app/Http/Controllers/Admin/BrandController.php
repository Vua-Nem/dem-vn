<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Repositories\BrandRepository;
use App\Models\SeoContent;
use App\Http\Controllers\AppBaseController;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Flash;
use Response;

class BrandController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Brand.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $brands = $this->brandRepository->paginate(15);

        return view('admin.brands.index')
            ->with('brands', $brands);
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param CreateBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        $input = $request->all();
        $brand = $this->brandRepository->create($input);
        Flash::success('Brand saved successfully.');

        return redirect(route('brands.index'));
    }

    /**
     * Display the specified Brand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }

        return view('admin.brands.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $brand = $this->brandRepository->find($id);
        $seoContent = SeoContent::where("entity_type", SeoContent::SEO_BRAND)
        ->where("entity_id", $brand->id)
        ->first();
        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }

        return view('admin.brands.edit')
			->with('seoContent', $seoContent)
            ->with('brand', $brand);
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param int $id
     * @param UpdateBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandRequest $request)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }

        if (isset($request->brand_img) && !empty($request->brand_img)) {
            $fileUpload = new FileUploadService();
            $path = "public/brands/" . $brand->id;
            $path = $fileUpload->upLoadImages($request->brand_img, $path, ["size" => ["150" => ["with" => 150, "height" => 150]]]);
            $brand->image = last(explode("/", $path));
            $brand->save();
        }

        $this->brandRepository->update($request->all(), $id);

        Flash::success('Brand updated successfully.');

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }

        $this->brandRepository->delete($id);

        Flash::success('Brand deleted successfully.');

        return redirect(route('brands.index'));
    }
}
