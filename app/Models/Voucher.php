<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Voucher
 * @package App\Models
 * @version February 24, 2021, 4:18 am UTC
 *
 * @property string $title
 * @property string $code
 * @property integer $voucher_type
 * @property integer $discount_type
 * @property integer $discount_value
 * @property integer $min_order_amount
 * @property integer $min_quantity_item
 * @property integer $start_date
 * @property integer $end_date
 * @property integer $status
 * @property integer $created_by
 */
class Voucher extends Model
{

    use HasFactory;

    public $table = 'vouchers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const VOUCHER_STATUS_IS_NOT_ACTIVE = 0;
    const VOUCHER_STATUS_IS_ACTIVE = 1;
	const VOUCHER_STATUS_IS_HIDDEN = 3;

    const VOUCHER_DISCOUNT_TYPE_IS_PERCENTAGE = 1;// Giảm theo phần trăm
    const VOUCHER_DISCOUNT_TYPE_IS_FIXED_AMOUNT = 2; //Giảm theo giá trị

    public $fillable = [
        'title',
        'code',
        'voucher_type',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'min_quantity_item',
        'start_date',
        'end_date',
        'status',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'code' => 'string',
        'voucher_type' => 'integer',
        'discount_type' => 'integer',
        'discount_value' => 'integer',
        'min_order_amount' => 'integer',
        'min_quantity_item' => 'integer',
        'start_date' => 'integer',
        'end_date' => 'integer',
        'status' => 'integer',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:250',
        'code' => 'required|string|max:50',
        'voucher_type' => 'required|integer',
        'discount_type' => 'required|integer',
        'discount_value' => 'required|integer',
        'start_date' => 'required',
        'end_date' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
