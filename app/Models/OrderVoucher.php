<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class OrderVoucher
 * @package App\Models
 * @version February 24, 2021, 8:09 am UTC
 *
 * @property integer $order_id
 * @property integer $voucher_id
 * @property integer $voucher_discount_type
 * @property integer $voucher_discount_value
 * @property integer $voucher_created_by
 * @property integer $voucher_start_date
 * @property integer $voucher_end_date
 */
class OrderVoucher extends Model
{

    use HasFactory;

    public $table = 'order_vouchers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'order_id',
        'voucher_id',
        'voucher_discount_type',
        'voucher_discount_value',
        'voucher_created_by',
        'voucher_start_date',
        'voucher_end_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'voucher_id' => 'integer',
        'voucher_discount_type' => 'integer',
        'voucher_discount_value' => 'integer',
        'voucher_created_by' => 'integer',
        'voucher_start_date' => 'integer',
        'voucher_end_date' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|integer',
        'voucher_id' => 'required|integer',
        'voucher_discount_type' => 'required|integer',
        'voucher_discount_value' => 'required|integer',
        'voucher_created_by' => 'required|integer',
        'voucher_start_date' => 'required|integer',
        'voucher_end_date' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
