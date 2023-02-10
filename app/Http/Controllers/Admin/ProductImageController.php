<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Repositories\ProductImageRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductImageController extends AppBaseController
{
    /** @var  ProductImageRepository */
    private $productImageRepository;

    public function __construct(ProductImageRepository $productImageRepo)
    {
        $this->productImageRepository = $productImageRepo;
    }

    /**
     * Display a listing of the ProductImage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $productImages = ProductImage::with('product')->paginate(15);

        return view('admin.product_images.index')
            ->with('productImages', $productImages);
    }

    /**
     * Show the form for creating a new ProductImage.
     *
     * @return Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.product_images.create', ['products' => $products]);
    }

    /**
     * Store a newly created ProductImage in storage.
     *
     * @param CreateProductImageRequest $request
     *
     * @return Response
     */
    public function store(CreateProductImageRequest $request)
    {
        $input = $request->all();

        $productImage = $this->productImageRepository->create($input);

        Flash::success('Product Image saved successfully.');

        return redirect(route('productImages.index'));
    }

    /**
     * Display the specified ProductImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productImage = ProductImage::with('product')->where('id', $id)->first();

        if (empty($productImage)) {
            Flash::error('Product Image not found');

            return redirect(route('productImages.index'));
        }

        return view('admin.product_images.show')->with('productImage', $productImage);
    }

    /**
     * Show the form for editing the specified ProductImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productImage = $this->productImageRepository->find($id);

        if (empty($productImage)) {
            Flash::error('Product Image not found');

            return redirect(route('productImages.index'));
        }
        $products = Product::all();

        return view('admin.product_images.edit')->with('productImage', $productImage)->with('products', $products);
    }

    /**
     * Update the specified ProductImage in storage.
     *
     * @param int $id
     * @param UpdateProductImageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductImageRequest $request)
    {
        $productImage = $this->productImageRepository->find($id);

        if (empty($productImage)) {
            Flash::error('Product Image not found');

            return redirect(route('productImages.index'));
        }

        $productImage = $this->productImageRepository->update($request->all(), $id);

        Flash::success('Product Image updated successfully.');

        return redirect(route('productImages.index'));
    }

    /**
     * Remove the specified ProductImage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productImage = $this->productImageRepository->find($id);

        if (empty($productImage)) {
            Flash::error('Product Image not found');

            return redirect(route('productImages.index'));
        }

        $this->productImageRepository->delete($id);

        Flash::success('Product Image deleted successfully.');

        return redirect()->back();
    }
}
