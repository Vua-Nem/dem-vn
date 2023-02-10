<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProductBundlesRequest;
use App\Http\Requests\UpdateProductBundlesRequest;
use App\Repositories\ProductBundlesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductBundlesController extends AppBaseController
{
    /** @var  ProductBundlesRepository */
    private $productBundlesRepository;

    public function __construct(ProductBundlesRepository $productBundlesRepo)
    {
        $this->productBundlesRepository = $productBundlesRepo;
    }

    /**
     * Display a listing of the ProductBundles.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $productBundles = $this->productBundlesRepository->all();

        return view('admin.product_bundles.index')
            ->with('productBundles', $productBundles);
    }

    /**
     * Show the form for creating a new ProductBundles.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.product_bundles.create');
    }

    /**
     * Store a newly created ProductBundles in storage.
     *
     * @param CreateProductBundlesRequest $request
     *
     * @return Response
     */
    public function store(CreateProductBundlesRequest $request)
    {
        $input = $request->all();
		$input['quantity_number'] = $input['quantity_number'] ?? 0;
        $productBundles = $this->productBundlesRepository->create($input);

        Flash::success('Product Bundles saved successfully.');

        return redirect(route('productBundles.index'));
    }

    /**
     * Display the specified ProductBundles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productBundles = $this->productBundlesRepository->find($id);

        if (empty($productBundles)) {
            Flash::error('Product Bundles not found');

            return redirect(route('productBundles.index'));
        }

        return view('admin.product_bundles.show')->with('productBundles', $productBundles);
    }

    /**
     * Show the form for editing the specified ProductBundles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productBundles = $this->productBundlesRepository->find($id);

        if (empty($productBundles)) {
            Flash::error('Product Bundles not found');

            return redirect(route('productBundles.index'));
        }

        return view('admin.product_bundles.edit')->with('productBundles', $productBundles);
    }

    /**
     * Update the specified ProductBundles in storage.
     *
     * @param int $id
     * @param UpdateProductBundlesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductBundlesRequest $request)
    {
        $productBundles = $this->productBundlesRepository->find($id);

        if (empty($productBundles)) {
            Flash::error('Product Bundles not found');

            return redirect(route('productBundles.index'));
        }

        $productBundles = $this->productBundlesRepository->update($request->all(), $id);

        Flash::success('Product Bundles updated successfully.');

        return redirect(route('productBundles.index'));
    }

    /**
     * Remove the specified ProductBundles from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productBundles = $this->productBundlesRepository->find($id);

        if (empty($productBundles)) {
            Flash::error('Product Bundles not found');

            return redirect(route('productBundles.index'));
        }

        $this->productBundlesRepository->delete($id);

        Flash::success('Product Bundles deleted successfully.');

        return redirect(route('productBundles.index'));
    }
}
