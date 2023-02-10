<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProductAttributeValueRequest;
use App\Http\Requests\UpdateProductAttributeValueRequest;
use App\Models\Attribute;
use App\Repositories\ProductAttributeValueRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductAttributeValueController extends AppBaseController
{
    /** @var  ProductAttributeValueRepository */
    private $productAttributeValueRepository;

    public function __construct(ProductAttributeValueRepository $productAttributeValueRepo)
    {
        $this->productAttributeValueRepository = $productAttributeValueRepo;
    }

    /**
     * Display a listing of the ProductAttributeValue.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $productAttributeValues = ProductAttributeValue::with(["productVariant", "product", "attributeValue", "attributeValue.attribute"])->paginate(15);

        return view('admin.product_attribute_values.index')
            ->with('productAttributeValues', $productAttributeValues);
    }

    /**
     * Show the form for creating a new ProductAttributeValue.
     *
     * @return Response
     */
    public function create()
    {
        $attributes = Attribute::all();
        $products = Product::all();
        return view('admin.product_attribute_values.create')->with("attributes", $attributes)->with('products', $products);
    }

    /**
     * Store a newly created ProductAttributeValue in storage.
     *
     * @param CreateProductAttributeValueRequest $request
     *
     * @return Response
     */
    public function store(CreateProductAttributeValueRequest $request)
    {
        $input = $request->all();

        $productAttributeValue = $this->productAttributeValueRepository->create($input);

        Flash::success('Product Attribute Value saved successfully.');

        return redirect(route('productAttributeValues.index'));
    }

    /**
     * Display the specified ProductAttributeValue.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productAttributeValue = ProductAttributeValue::with(["productVariant", "product", "attributeValue", "attributeValue.attribute"])
            ->where('id', $id)
            ->first();

        if (empty($productAttributeValue)) {
            Flash::error('Product Attribute Value not found');

            return redirect(route('productAttributeValues.index'));
        }

        return view('admin.product_attribute_values.show')->with('productAttributeValue', $productAttributeValue);
    }

    /**
     * Show the form for editing the specified ProductAttributeValue.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productAttributeValue = $this->productAttributeValueRepository->find($id);

        if (empty($productAttributeValue)) {
            Flash::error('Product Attribute Value not found');

            return redirect(route('productAttributeValues.index'));
        }

        return view('admin.product_attribute_values.edit')->with('productAttributeValue', $productAttributeValue);
    }

    /**
     * Update the specified ProductAttributeValue in storage.
     *
     * @param int $id
     * @param UpdateProductAttributeValueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductAttributeValueRequest $request)
    {
        $productAttributeValue = $this->productAttributeValueRepository->find($id);

        if (empty($productAttributeValue)) {
            Flash::error('Product Attribute Value not found');

            return redirect(route('productAttributeValues.index'));
        }

        $productAttributeValue = $this->productAttributeValueRepository->update($request->all(), $id);

        Flash::success('Product Attribute Value updated successfully.');

        return redirect(route('productAttributeValues.index'));
    }

    /**
     * Remove the specified ProductAttributeValue from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productAttributeValue = $this->productAttributeValueRepository->find($id);

        if (empty($productAttributeValue)) {
            Flash::error('Product Attribute Value not found');

            return redirect(route('productAttributeValues.index'));
        }

        $this->productAttributeValueRepository->delete($id);

        Flash::success('Product Attribute Value deleted successfully.');

        return redirect(route('productAttributeValues.index'));
    }
}
