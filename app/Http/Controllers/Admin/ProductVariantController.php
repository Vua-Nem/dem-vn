<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use App\Repositories\ProductVariantRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Response;

class ProductVariantController extends AppBaseController
{
    /** @var  ProductVariantRepository */
    private $productVariantRepository;

    public function __construct(ProductVariantRepository $productVariantRepo)
    {
        $this->productVariantRepository = $productVariantRepo;
    }

    /**
     * Display a listing of the ProductVariant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $productVariants = $this->productVariantRepository->paginate(15);

        return view('admin.product_variants.index')
            ->with('productVariants', $productVariants);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        if (!isset($request->product_id))
            return redirect(route('products.index'));

        $attributes = Attribute::all();
        $product = Product::with(['productAttributeValue' => function ($query) {
            $query->where('product_variant_id', '>', 0);
        }, "productAttributeValue.attributeValue"])->where("id", $request->product_id)->first();

        $variantAttribute = $attributeValue = [];
        if ($product->productAttributeValue->count()) {
            foreach ($product->productAttributeValue as $value) {
                $variantAttribute[] = $value->attributeValue->attribute_id;
            }
        }

        if (!empty($variantAttribute))
            $attributeValue = AttributeValue::whereIn("attribute_id", $variantAttribute)->get();

        return view('admin.product_variants.create')
            ->with("variantAttribute", $variantAttribute)
            ->with("variantAttributeValue", $attributeValue)
            ->with("attributes", $attributes)
            ->with("product", $product);
    }

    /**
     * Store a newly created ProductVariant in storage.
     *
     * @param CreateProductVariantRequest $request
     *
     * @return Response
     */
    public function store(CreateProductVariantRequest $request)
    {
        $input = $request->all();
        $input["slug"] = Str::slug($input["name"]);
        $result = $this->variantAttributeValidate(
            $input["product_id"],
            $input["attribute_id_1"],
            $input["attribute_value_id_1"],
            $input["attribute_id_2"],
            $input["attribute_value_id_2"]
        );

        if (!$result["status"]) {
            Flash::error($result["message"]);
            return redirect()->back();
        }

        try {
            DB::beginTransaction();
            $variant = $this->productVariantRepository->create($input);
            $this->createProductVariantAttribute(
                $input["product_id"],
                $variant->id,
                [$input["attribute_value_id_1"], $input["attribute_value_id_2"]]
            );
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        Flash::success('Product Variant saved successfully.');

        return redirect(route('productVariants.index'));
    }

    /**
     * @param $product_id
     * @param $variant_id
     * @param $aryAttributeValue
     * @return bool
     */
    public function createProductVariantAttribute($product_id, $variant_id, $aryAttributeValue = [])
    {
        foreach ($aryAttributeValue as $attribute_value) {
            if ($attribute_value == 0) continue;

            $productAttribute = new ProductAttributeValue();
            $productAttribute->product_id = $product_id;
            $productAttribute->product_variant_id = $variant_id;
            $productAttribute->attribute_value_id = $attribute_value;
            $productAttribute->save();
        }

        return true;
    }

    /**
     * @param $product_id
     * @param int $attr1
     * @param int $attrValue1
     * @param int $attr2
     * @param int $attrValue2
     * @return array
     */
    public function variantAttributeValidate($product_id, $attr1, $attrValue1, $attr2 = 0, $attrValue2 = 0)
    {
        if ($attr1 == $attr2)
            return ["status" => false, "message" => "Duplicate Attribute"];

        if ($attrValue1 == $attrValue2)
            return ["status" => false, "message" => "Duplicate Attribute Value"];

        $product = Product::with(['productAttributeValue' => function ($query) {
            $query->where('product_variant_id', '>', 0);
        }, "productAttributeValue.attributeValue"])->where("id", $product_id)->first();

        if ($product->productAttributeValue->count() == 0)
            return ["status" => true, "messages" => ""];

        $aryAttrId = $attributeValueKey = [];
        foreach ($product->productAttributeValue as $attributeValue) {
            /*Nhỏ hơn 3 vì mình chỉ cho tôi đa 2 option thôi*/
            if (count($aryAttrId) < 3)
                $aryAttrId[$attributeValue->attributeValue->attribute_id] = $attributeValue->attributeValue->attribute_id;

            if (isset($attributeValueKey[$attributeValue->product_variant_id])) {
                $attributeValueKey[$attributeValue->product_variant_id] .= "_" . $attributeValue->attribute_value_id;
                continue;
            }

            $attributeValueKey[$attributeValue->product_variant_id] = $attributeValue->attribute_value_id;
        }

        $valueKey = '';
        if ($attrValue1 != 0)
            $valueKey = $attrValue1;

        if ($attr2 != 0)
            $valueKey = $valueKey . "_" . $attrValue2;

        if (in_array($valueKey, $attributeValueKey))
            return ["status" => false, "message" => "Attribute available !"];

        if ($attr1 != 0) {
            if (!in_array($attr1, $aryAttrId))
                return ["status" => false, "message" => "Attribute 1 ID not in array !"];
        }

        if ($attr2 != 0) {
            if (!in_array($attr2, $aryAttrId))
                return ["status" => false, "message" => "Attribute 2 ID not in array !"];
        }

        $attrValues = AttributeValue::whereIn("id", [$attrValue1, $attrValue2])->get();
        foreach ($attrValues as $val) {
            if (!in_array($val->attribute_id, $aryAttrId))
                return ["status" => false, "message" => "Attribute value 1 ID not in array !"];
        }

        return ["status" => true, "messages" => ""];
    }

    /**
     * Display the specified ProductVariant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productVariant = $this->productVariantRepository->find($id);

        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('productVariants.index'));
        }

        return view('admin.product_variants.show')->with('productVariant', $productVariant);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id, Request $request)
    {
        $productVariant = ProductVariant::with([
            "productAttributeValue",
            "productAttributeValue.attributeValue",
            "productAttributeValue.attributeValue.attribute"
        ])->find($id);

        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('productVariants.index'));
        }

        if (!isset($request->product_id))
            return redirect(route('products.index'));

        $product = Product::find($request->product_id);

        return view('admin.product_variants.edit')
            ->with('product', $product)
            ->with('productVariant', $productVariant);
    }

    /**
     * Update the specified ProductVariant in storage.
     *
     * @param int $id
     * @param UpdateProductVariantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductVariantRequest $request)
    {
        $productVariant = $this->productVariantRepository->find($id);

        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('productVariants.index'));
        }

        $dataUpdate = $request->all();

        $dataUpdate["slug"] = Str::slug($dataUpdate["name"]);

        $this->productVariantRepository->update($request->all(), $id);

        Flash::success('Product Variant updated successfully.');

        return redirect()->route('products.edit', [$productVariant->product_id]);
    }

    /**
     * Remove the specified ProductVariant from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productVariant = $this->productVariantRepository->find($id);
        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('productVariants.index'));
        }

        try {
            DB::beginTransaction();
            $this->productVariantRepository->delete($id);
            ProductAttributeValue::where("product_variant_id", $id)->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        Flash::success('Product Variant deleted successfully.');

        return redirect(route('productVariants.index'));
    }

}
