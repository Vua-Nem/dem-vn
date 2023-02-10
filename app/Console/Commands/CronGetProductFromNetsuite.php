<?php

namespace App\Console\Commands;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use App\Models\TmpProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CronGetProductFromNetsuite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CronGetProductFromNetSuite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $this->getProductToTMPProduct();
//        $this->createProducts();
//        $this->createProductVariant();
//        $this->createVendorStatusAndUpdateProducts();
        return true;
    }

    public function getProductToTMPProduct()
    {
        $query = "SELECT 
            INVENTORY_ITEMS.ITEM_ID,
            INVENTORY_ITEMS.FULL_NAME as ITEM_CODE,
            INVENTORY_ITEMS.DISPLAYNAME,
            INVENTORY_ITEMS.SALESPRICE AS BASE_PRICE,
            INVENTORY_STATUS.LIST_ITEM_NAME as ITEM_STATUS,
            U1.NAME AS UNITS_TYPE,
            U2.NAME AS PRIMARY_PURCHASE_UNIT,
            U3.NAME AS PRIMARY_SALE_UNIT,
            U4.NAME AS PRIMARY_STOCK_UNIT,
            LIST__ITEM_MATERIAL.LIST_ITEM_NAME AS MATERIAL,
            INVENTORY_ITEMS.WIDTH,
            INVENTORY_ITEMS.LENGTH_0,
            INVENTORY_ITEMS.THICKNESS,
            LIST__MATTRESS_COMFORT_LEVELS.LIST_ITEM_NAME AS MATTRESS_COMFORT_LEVELS,
            LIST__ITEM_FEATURE.LIST_ITEM_NAME AS FEATURE,
            LIST__ITEM_COLOR.LIST_ITEM_NAME AS COLOR,
            LIST__PATTERN.LIST_ITEM_NAME AS PATTERN,
            INVENTORY_ITEMS.WARRANTY,
            CATEGORY.PRODUCT_GROUP AS CATEGORY,
            CATEGORY.NAME AS PRODUCT,
            CATEGORY.FULL_NAME AS CATEGRORY_GROUP_BRAND_PRODUCT
            FROM \"Vua Nem Joint Stock Company\".Administrator.INVENTORY_ITEMS
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.INVENTORY_STATUS
            ON INVENTORY_STATUS.LIST_ID = INVENTORY_ITEMS.ITEM_STATUS_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.UNITS_TYPE AS U1
            ON U1.UNITS_TYPE_ID = INVENTORY_ITEMS.UNITS_TYPE_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.UNITS_TYPE AS U2
            ON U2.UNITS_TYPE_ID = INVENTORY_ITEMS.PURCHASE_UNIT_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.UNITS_TYPE AS U3
            ON U3.UNITS_TYPE_ID = INVENTORY_ITEMS.SALE_UNIT_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.UNITS_TYPE AS U4
            ON U4.UNITS_TYPE_ID = INVENTORY_ITEMS.STOCK_UNIT_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.LIST__ITEM_MATERIAL
            ON LIST__ITEM_MATERIAL.LIST_ID = INVENTORY_ITEMS.MATERIAL_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.LIST__MATTRESS_COMFORT_LEVELS
            ON LIST__MATTRESS_COMFORT_LEVELS.LIST_ID = INVENTORY_ITEMS.MATTRESS_COMFORT_LEVELS_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.LIST__ITEM_FEATURE
            ON LIST__ITEM_FEATURE.LIST_ID = INVENTORY_ITEMS.FEATURE_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.LIST__ITEM_COLOR
            ON LIST__ITEM_COLOR.LIST_ID = INVENTORY_ITEMS.COLOR_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.LIST__PATTERN
            ON LIST__PATTERN.LIST_ID = INVENTORY_ITEMS.PATTERN_ID
            LEFT JOIN \"Vua Nem Joint Stock Company\".Administrator.ITEMS
            ON ITEMS.ITEM_ID = INVENTORY_ITEMS.ITEM_ID
            LEFT JOIN 
                (SELECT 
                DISTINCT CLASSES.PRODUCT_GROUP_CODE,
                CLASSES.NAME, CLASSES.CLASS_ID,
                CLASSES.FULL_NAME,
                CASE
                WHEN SUBSTRING(FULL_NAME,1,1) = '1' THEN '1-Mattress'
                WHEN SUBSTRING(FULL_NAME,1,1) = '2' THEN '2-Bed Linen'
                WHEN SUBSTRING(FULL_NAME,1,1) = '3' THEN '3-Accessories'
                WHEN SUBSTRING(FULL_NAME,1,1) = '4' THEN '4-Furniture'
                END AS PRODUCT_GROUP
            FROM \"Vua Nem Joint Stock Company\".Administrator.CLASSES CLASSES
            WHERE CLASSES.PRODUCT_GROUP_CODE IS NOT NULL
            AND SUBSTRING(FULL_NAME,1,1) in ('1','2','3','4')
            ) AS CATEGORY
            ON CATEGORY.CLASS_ID = ITEMS.CLASS_ID
            WHERE CATEGORY.NAME IS NOT NULL";

        $data = Http::post("http://1.53.252.228:3100", [
            "query" => $query
        ])->json();

        try {
            DB::beginTransaction();
            foreach ($data as $value) {

                $parent = explode("-", $value["PRODUCT"]);

                $model = new TmpProduct();
                $model->product_id = $value["ITEM_ID"];
                $model->sku = $value["ITEM_CODE"];
                $model->content = json_encode($value);
                $model->product_parent = $parent[0];
                $model->category = $value["CATEGORY"];
                $model->status = empty($value["ITEM_STATUS"]) ? "default_nul" : $value["ITEM_STATUS"];
                $model->save();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            pr($exception->getMessage() . " - " . $exception->getLine());
        }

        return true;
    }

    public function createProducts()
    {
        try {
            $data = TmpProduct::where("create_product_status", 0)->take(500)->get();
            foreach ($data as $val) {

                $val->create_product_status = 1;
                $val->save();
                $ary = json_decode($val->content, true);
                $product = Product::where("sku", $val->product_parent)->count();
                if ($product) continue;

                $price = ($ary["BASE_PRICE"] == null) ? 0 : $ary["BASE_PRICE"];
                $product = new Product();
                $product->sku = $val->product_parent;
                $product->name = $ary["DISPLAYNAME"];
                $product->slug = Str::slug($ary["DISPLAYNAME"]);
                $product->price = $price;
                $product->compare_price = $price;
                $product->qty = 0;
                $product->brand_id = 0;
                $product->status = 1;
                $product->save();
            }

        } catch (\Exception $exception) {
            pd($exception->getMessage(), $exception->getLine());
        }
    }

    public function createProductVariant()
    {
        $data = TmpProduct::where("create_variant_status", 0)->take(500)->get();

        try {
            DB::beginTransaction();
            foreach ($data as $val) {
                $product = Product::where("sku", $val->product_parent)->first();
                if (empty($product)) continue;

                $val->create_variant_status = 1;
                $val->save();

                $aryData = json_decode($val->content, true);
                $variantID = $this->createVariant($product->id, $aryData);

                if ($val->category == "1-Mattress") {
                    $this->createVariantMattressAttr($aryData, $product->id, $variantID);
                    continue;
                }

                if ($val->category == "2-Bed Linen") {
                    $this->createVariantBedLinenAttr($aryData, $product->id, $variantID);
                    continue;
                }

                if ($val->category == "4-Furniture") {
                    $this->createVariantFurnitureAttr($aryData, $product->id, $variantID);
                    continue;
                }

                if ($val->category == "3-Accessories") {
                    $this->createVariantAccessoriesAttr($aryData, $product->id, $variantID);
                    continue;
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            pr($val);
            pr($exception->getMessage(), $exception->getLine());
        }

        return true;
    }

    /**
     * @param $productID
     * @param $aryData
     * @return mixed
     */
    public function createVariant($productID, $aryData)
    {
        $name = empty($aryData["DISPLAYNAME"]) ? "no name" : $aryData["DISPLAYNAME"];
        $price = empty($aryData["BASE_PRICE"]) ? 0 : $aryData["BASE_PRICE"];

        $variant = new ProductVariant();
        $variant->product_id = $productID;
        $variant->name = $name;
        $variant->slug = Str::slug($name);
        $variant->sku = $aryData["ITEM_CODE"];
        $variant->price = $price;
        $variant->compare_price = $price;
        $variant->qty = $aryData["WARRANTY"];
        $variant->save();

        return $variant->id;
    }

    /**
     * @param $tmpProduct
     * @param $productID
     * @param $variantID
     */
    public function createVariantMattressAttr($tmpProduct, $productID, $variantID)
    {
        $sizeValue = $this->createAttribute("size", $tmpProduct["WIDTH"] . "x" . $tmpProduct["LENGTH_0"]);
        $this->createProductAttribute($productID, $variantID, $sizeValue["value"]);

        $thicknessValue = $this->createAttribute("thickness", $tmpProduct["THICKNESS"]);
        $this->createProductAttribute($productID, $variantID, $thicknessValue["value"]);
    }

    /**
     * @param $tmpProduct
     * @param $productID
     * @param $variantID
     */
    public function createVariantBedLinenAttr($tmpProduct, $productID, $variantID)
    {
        $colorValue = $this->createAttribute("color", $tmpProduct["COLOR"]);
        $this->createProductAttribute($productID, $variantID, $colorValue["value"]);

        $sizeValue = $this->createAttribute("size", $tmpProduct["WIDTH"] . "x" . $tmpProduct["LENGTH_0"]);
        $this->createProductAttribute($productID, $variantID, $sizeValue["value"]);
    }

    /**
     * @param $tmpProduct
     * @param $productID
     * @param $variantID
     */
    public function createVariantAccessoriesAttr($tmpProduct, $productID, $variantID)
    {
        $colorValue = $this->createAttribute("color", $tmpProduct["COLOR"]);
        $this->createProductAttribute($productID, $variantID, $colorValue["value"]);

        $sizeValue = $this->createAttribute("size", $tmpProduct["WIDTH"] . "x" . $tmpProduct["LENGTH_0"]);
        $this->createProductAttribute($productID, $variantID, $sizeValue["value"]);
    }

    /**
     * @param $tmpProduct
     * @param $productID
     * @param $variantID
     */
    public function createVariantFurnitureAttr($tmpProduct, $productID, $variantID)
    {
        $colorValue = $this->createAttribute("color", $tmpProduct["COLOR"]);
        $this->createProductAttribute($productID, $variantID, $colorValue["value"]);

        $sizeValue = $this->createAttribute("size", $tmpProduct["WIDTH"] . "x" . $tmpProduct["LENGTH_0"]);
        $this->createProductAttribute($productID, $variantID, $sizeValue["value"]);
    }

    /**
     * @param $productID
     * @param $variantID
     * @param $attributeValueID
     * @return ProductAttributeValue
     */
    public function createProductAttribute($productID, $variantID, $attributeValueID)
    {
        $productAttr = new ProductAttributeValue();
        $productAttr->product_id = $productID;
        $productAttr->product_variant_id = $variantID;
        $productAttr->attribute_value_id = $attributeValueID;
        $productAttr->save();

        return $productAttr;
    }

    /**
     * @param $attrName
     * @param $attrValue
     * @return array
     */
    public function createAttribute($attrName, $attrValue)
    {
        $attr = Attribute::where("attribute_code", Str::slug($attrName, "_"))->first();

        if (empty($attr)) {
            $attr = new Attribute();
            $attr->attribute_code = Str::slug($attrName, "_");
            $attr->name = $attrName;
            $attr->save();
        }

        $valueId = $this->createAttributeValue($attr->id, $attrValue);
        return ["attr" => $attr->id, "value" => $valueId];
    }

    /**
     * @param $attributeID
     * @param $value
     * @return mixed
     */
    public function createAttributeValue($attributeID, $value)
    {
        if (empty($value)) $value = "default";

        $attrValue = AttributeValue::where("attribute_id", $attributeID)
            ->where("code", Str::slug($value, "_"))
            ->first();

        if (empty($attrValue)) {
            $attrValue = new AttributeValue();
            $attrValue->attribute_id = $attributeID;
            $attrValue->code = Str::slug($value, "_");
            $attrValue->value = $value;
            $attrValue->save();
        }

        return $attrValue->id;
    }

    /**
     * @return bool
     * Tao Brand sau đó update ID brand vào bảng sản phẩm
     */
    public function createVendorStatusAndUpdateProducts()
    {
        try {
            DB::beginTransaction();

            $brands = TmpProduct::where("create_brand_status", 0)->take(500)->get();
            foreach ($brands as $brand) {
                $aryData = json_decode($brand->content, true);

                list($category, $group, $brandName) = explode(":", $aryData["CATEGRORY_GROUP_BRAND_PRODUCT"]);

                $brandID = $this->createBrand($brandName);
                $product = Product::where("sku", $brand->product_parent)->first();

                if (empty($product)) continue;

                $product->brand_id = $brandID;
                $product->save();

                $brand->create_brand_status = 1;
                $brand->save();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            pd($exception->getMessage(), $exception->getLine());
        }

        return true;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function createBrand($name)
    {
        $brand = Brand::where("name", $name)->first();

        if (empty($brand)) {
            $brand = new Brand();
            $brand->name = $name;
            $brand->save();
        }

        return $brand->id;
    }
}
