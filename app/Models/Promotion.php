<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Promotion
 * @package App\Models
 * @version December 29, 2020, 2:07 am UTC
 *
 * @property integer $id
 * @property string $title
 * @property integer $promotion_type
 * @property integer $discount_type
 * @property integer $discount_value
 * @property integer $min_order_amount
 * @property integer $min_quantity_item
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 */
class Promotion extends Model
{

    use HasFactory;

    public $table = 'promotions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PROMOTION_TYPE_FOR_ALL_PRODUCT = 1;
    const PROMOTION_TYPE_FOR_CATEGORY = 2;
    const PROMOTION_TYPE_FOR_SPECIFIC = 3;

    const PROMOTION_DISCOUNT_TYPE_IS_PERCENTAGE = 1;
    const PROMOTION_DISCOUNT_TYPE_IS_FIXED_AMOUNT = 2;

    const PROMOTION_STATUS_IS_ACTIVE = 1;
    const PROMOTION_STATUS_IS_DISABLE = 2;

    public static $promotionStatus = [
        self::PROMOTION_STATUS_IS_ACTIVE => "Active",
        self::PROMOTION_STATUS_IS_DISABLE => "Disable",
    ];

    public static $promotionType = [
        self::PROMOTION_TYPE_FOR_ALL_PRODUCT => "Áp dụng cho toàn bộ sản phẩm",
        self::PROMOTION_TYPE_FOR_CATEGORY => "Áp dụng cho Category",
        self::PROMOTION_TYPE_FOR_SPECIFIC => "Áp dụng cho các sản phẩm riêng lẻ",
    ];


    public static $discountType = [
        self::PROMOTION_DISCOUNT_TYPE_IS_PERCENTAGE => "Phần trăm",
        self::PROMOTION_DISCOUNT_TYPE_IS_FIXED_AMOUNT => "Giá trị",
    ];

    public $fillable = [
        'title',
        'promotion_type',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'min_quantity_item',
        'start_date',
        'end_date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'promotion_type' => 'integer',
        'discount_type' => 'integer',
        'discount_value' => 'integer',
        'min_order_amount' => 'integer',
        'min_quantity_item' => 'integer',
        'start_date' => 'string',
        'end_date' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:250',
        'promotion_type' => 'required|integer',
        'discount_type' => 'required|integer',
        'discount_value' => 'required|integer',
        'min_order_amount' => 'integer',
        'min_quantity_item' => 'integer',
        'start_date' => 'required|string',
        'end_date' => 'required|string',
        'status' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function promotionObjects()
    {
        return $this->hasMany(PromotionObject::class, "promotion_id", "id");
    }

}
