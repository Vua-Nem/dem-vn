<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Orders
 * @package App\Models
 * @version January 7, 2021, 10:43 am UTC
 *
 * @property integer $user_id
 * @property integer $id
 * @property string $user_name
 * @property string $email
 * @property string $phone_number
 * @property integer $province_id
 * @property integer $district_id
 * @property string $address
 * @property string $description
 * @property integer $amount
 * @property integer $real_amount
 * @property integer $created_by
 * @property boolean $status
 * @property boolean $payment_method
 * @property boolean $payment_status
 */
class Orders extends Model
{

    use HasFactory;

    public $table = 'orders';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const ORDER_STATUS_IS_PENDING = 1; //ĐƠN HÀNG MỚI ĐANG CHỜ XỬ LÝ
    const ORDER_STATUS_IS_COMPLETE = 2; //ĐƠN HÀNG THÀNH CÔNG
    const ORDER_STATUS_IS_REFUND = 3; //ĐƠN HÀNG HỦY

    public static $orderStatus = [
        self::ORDER_STATUS_IS_PENDING => "Đơn hàng mới",
        self::ORDER_STATUS_IS_COMPLETE => "Đơn hàng thành công",
        self::ORDER_STATUS_IS_REFUND => "Đơn hàng hủy",
    ];

    const ORDER_PAYMENT_METHOD_IS_COD = 1; //Thanh toán bằng tiền mặt
    const ORDER_PAYMENT_METHOD_IS_VNP = 2; //Thanh toán bằng tiền mặt
    const ORDER_PAYMENT_METHOD_IS_INTERNET_BANKING = 3; //Thanh toán chuyển khoản ngân hàng
    const ORDER_PAYMENT_METHOD_IS_PAYOO = 4; //Thanh toán trả góp qua PAYOO

    const ORDER_PAYMENT_STATUS_IS_PENDING = 1; // Chờ thanh toán
    const ORDER_PAYMENT_STATUS_IS_COMPLETE = 2; // Đã thanh toán
    const ORDER_PAYMENT_STATUS_IS_FAILS = 3; // Đã thanh toán

    public static $paymentMethod = [
        self::ORDER_PAYMENT_METHOD_IS_COD => "Thanh toán khi nhận hàng",
        self::ORDER_PAYMENT_METHOD_IS_VNP => "Thanh toán qua VNPay",
        self::ORDER_PAYMENT_METHOD_IS_INTERNET_BANKING => "Thanh toán bằng chuyển khoản ngân hàng",
        self::ORDER_PAYMENT_METHOD_IS_PAYOO => "Thanh toán trả góp qua PAYOO",
    ];

    public $fillable = [
        'user_id',
        'user_name',
        'email',
        'phone_number',
        'province_id',
        'district_id',
        'address',
        'description',
        'amount',
        'real_amount',
        'created_by',
        'status',
        'payment_method',
        'payment_status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'user_name' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'province_id' => 'integer',
        'district_id' => 'integer',
        'address' => 'string',
        'description' => 'string',
        'amount' => 'integer',
        'real_amount' => 'integer',
        'created_by' => 'integer',
        'status' => 'integer',
        'payment_method' => 'integer',
        'payment_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_name' => 'required|string|max:250',
        'phone_number' => 'required|string|max:50',
        'province_id' => 'required|integer',
        'district_id' => 'required|integer',
        'address' => 'required|string|max:250',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, "order_id", "id");
    }

    public function province()
    {
        return $this->hasOne(Province::class, "id", "province_id");
    }

    public function district()
    {
        return $this->hasOne(District::class, "id", "district_id");
    }

    public function OrderVoucher()
    {
        return $this->hasOne(OrderVoucher::class, "order_id", "id");
    }
}
