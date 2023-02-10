<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ProductVariant
 * @package App\Models
 * @version December 22, 2020, 9:16 am UTC
 *
 * @property integer $product_id
 * @property string $name
 * @property string $slug
 * @property string $sku
 * @property integer $price
 * @property integer $compare_price
 * @property integer $qty
 * @property integer $status
 * @property integer $length
 * @property integer $width
 * @property integer $thickness
 */
class ProductVariant extends Model
{

    use HasFactory;

    public $table = 'product_variants';

    const PRODUCT_STATUS_IS_ACTIVE = 1;
    const PRODUCT_STATUS_IS_DISABLE = 0;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'product_id',
        'name',
        'slug',
        'sku',
        'price',
        'compare_price',
        'qty',
        'status',
        'thickness',
        'width',
        'length'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'sku' => 'string',
        'price' => 'integer',
        'compare_price' => 'integer',
        'qty' => 'integer',
        'status' => 'integer',
        'width' => 'integer',
        'length' => 'integer',
        'thickness' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|integer',
        'name' => 'required|string|max:250',
        'slug' => 'string|max:250',
        'sku' => 'required|string|max:30',
        'price' => 'required|integer',
        'compare_price' => 'required|integer',
        'qty' => 'required|integer',
        'status' => 'required|integer',
        'width' => 'required|integer',
        'length' => 'required|integer',
        'thickness' => 'required|integer',
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

    /**
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    public function promotionObjects()
    {
        return $this->hasMany(PromotionObject::class, "object_id", "sku");
    }

    public function productAttributeValue()
    {
        return $this->hasMany(ProductAttributeValue::class, "product_variant_id", "id");
    }
}
