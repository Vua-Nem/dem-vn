<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Product
 * @package App\Models
 * @version December 21, 2020, 7:56 am UTC
 *
 * @property integer $id
 * @property string $sku
 * @property string $name
 * @property string $slug
 * @property string $qty
 * @property integer $price
 * @property integer $compare_price
 * @property boolean $product_type
 * @property boolean $brand_id
 * @property boolean $status
 * @property string $video_url
 */
class Product extends Model
{

    use HasFactory;

    public $table = 'products';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PRODUCT_STATUS_IS_ACTIVE = 1;
    const PRODUCT_STATUS_IS_DISABLE = 2;


    public $fillable = [
        'id',
        'sku',
        'name',
        'slug',
        'price',
        'total_sale',
        'compare_price',
        'brand_id',
        'category_id',
        'status',
        'qty',
        'video_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sku' => 'string',
        'name' => 'string',
        'slug' => 'string',
        'price' => 'integer',
        'total_sale' => 'integer',
        'compare_price' => 'integer',
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'qty' => 'integer',
        'status' => 'integer',
        'video_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sku' => 'required|string|max:30',
        'name' => 'required|string|max:255',
        'slug' => 'string|max:255',
        'price' => 'required|integer',
        'qty' => 'integer',
        'compare_price' => 'required|integer',
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'video_url' => 'string|nullable',
        'status' => 'required|integer',
        'shortDescriptions.*.name' => 'max:255|nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @var array
     */
    public static $status = [
        self::PRODUCT_STATUS_IS_ACTIVE => 'Active',
        self::PRODUCT_STATUS_IS_DISABLE => 'Disable',
    ];

    public function brand()
    {
        return $this->hasOne(Brand::class, "id", "brand_id");
    }

    public function category()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }

    public function description()
    {
        return $this->hasOne(ProductDescription::class, "product_id", "id");
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, "product_id", "id");
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, "product_id", "id");
    }

    public function productAttributeValue()
    {
        return $this->hasMany(ProductAttributeValue::class, "product_id", "id");
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, "entity_id", "id");
    }

    public function shortDescriptions()
    {
        return $this->hasMany(ProductShortDescription::class, "product_id", "id");
    }
}
