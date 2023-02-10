<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Builder;
use App\Models\SeoContent;
use Illuminate\Support\Facades\Cache;

/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 12/21/2020
 * Time: 5:50 PM
 */
Class ProductService
{
    /**
     * @param string $sku
     * @return mixed
     */
    public function getProductBySku(string $sku)
    {
        $variant = ProductVariant::where("sku", $sku)->first();
        $product = Product::with([
            "variants" => function ($query) {
                $query->where('status', ProductVariant::PRODUCT_STATUS_IS_ACTIVE);
            }
        ])->where("id", $variant->product_id)->first();

        return $product;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProductById($id)
    {
        $product = Product::with([
            "variants" => function ($query) {
                $query->where('status', ProductVariant::PRODUCT_STATUS_IS_ACTIVE);
            }
        ])->where("id", $id)->first();

        return $product;
    }

        /**
     * @param $productId
     * @return mixed
     */
    public function getProductSeoContent($productId)
    {
        $data = Cache::remember("seo_content_entity_id_v2" . $productId, 1, function () use ($productId) {
            return SeoContent::where("entity_type", SeoContent::SEO_PRODUCT)
                ->where("entity_id", $productId)->first();
        });

        return $data;
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function getProductByIds($ids)
    {
        $products = Product::with([
            "variants" => function ($query) {
                $query->where('status', ProductVariant::PRODUCT_STATUS_IS_ACTIVE);
            }
        ])->whereIn("id", $ids)->get();

        return $products;
    }

    /**
     * @param $products
     * @return mixed
     */
    public function addPromotionToProducts($products)
    {
        foreach ($products as $product) {
            $this->addPromotionToProduct($product);
        }

        return $products;
    }

    /**
     * @param $product
     * @return array
     */
    public function addPromotionToProduct($product)
    {
        $seconds = 84600;
        $key = 'cache_key_product_promotion_id_v2_' . $product->id;
        $promotions = Cache::remember($key, $seconds, function () use ($product) {
            $promotions = $this->getPromotionBySku($product->variants->pluck("sku")->toArray());
            return $promotions;
        });

        foreach ($product->variants as $variant) {
            foreach ($promotions as $promotion) {
                if (!in_array($variant->sku, $promotion["object_ids"])) continue;

                $discount_value = $promotion["discount_value"];
                if ($promotion["discount_type"] == Promotion::PROMOTION_DISCOUNT_TYPE_IS_PERCENTAGE)
                    $discount_value = ($promotion["discount_value"] * $variant->price) / 100;

                if (isset($variant->promotion_discount) && $variant->promotion_discount > $discount_value) continue;

                $variant->promotion_id = $promotion["id"];
                $variant->promotion_name = $promotion["title"];
                $variant->promotion_discount = $discount_value;
                $variant->promotion_end = $promotion["end_date"];
            }
        }

        return $product;
    }

    /**
     * @param array $arySku
     * @return array
     */
    public function getPromotionBySku($arySku)
    {
        if (empty($arySku)) return [];

        $arySku = array_map(function ($value) {
            return (string)$value;
        }, $arySku);

        $promotions = Promotion::with("promotionObjects")->where("status", Promotion::PROMOTION_STATUS_IS_ACTIVE)
            ->where("start_date", "<=", time())
            ->where("end_date", ">", time())
            ->whereHas('promotionObjects', function (Builder $query) use ($arySku) {
                $query->whereIn("object_id", $arySku);
            })->get();

        foreach ($promotions as $promotion) {
            $productPromotion[] = [
                'id' => $promotion->id,
                'title' => $promotion->title,
                'promotion_type' => $promotion->promotion_type,
                'discount_type' => $promotion->discount_type,
                'discount_value' => $promotion->discount_value,
                'min_order_amount' => $promotion->min_order_amount,
                'min_quantity_item' => $promotion->min_quantity_item,
                'start_date' => $promotion->start_date,
                'end_date' => $promotion->end_date,
                'object_ids' => $promotion->promotionObjects->pluck("object_id")->toArray()
            ];
        }

        return $productPromotion ?? [];
    }

    /**
     * @param $productId
     * @return array
     */
    public function getProductVariantGroupByAttribute($productId)
    {
        $aryGroupAttr = [];
        $productAttributeValue = ProductAttributeValue::with(["attributeValue", "attributeValue.attribute"])
            ->where("product_id", $productId)
            ->get(["product_id", "product_variant_id", "attribute_value_id"]);

        foreach ($productAttributeValue as $value) {
            $aryVariants[$value->product_variant_id][] = $value->attributeValue->value;
            $aryGroupAttr["attributeName"][$value->attributeValue->attribute->attribute_code] = $value->attributeValue->attribute->name;
        }

        if (isset($aryVariants)) {
            foreach ($aryVariants as $key => $value) {
                $aryGroupAttr["attributeGroup"][$value[0]][$key] = isset($value[1]) ? $value[1] : null;
            }
        }

        return $aryGroupAttr;
    }
}