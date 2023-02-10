<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class VNPayCallLogs
 * @package App\Models
 * @version January 21, 2021, 9:07 am UTC
 *
 * @property integer $order_id
 * @property integer $transaction_id
 * @property string $bank_code
 * @property string $data
 */
class VNPayCallLogs extends Model
{

    use HasFactory;

    public $table = 'vn_pay_call_logs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'order_id',
        'transaction_id',
        'bank_code',
        'data'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'transaction_id' => 'integer',
        'bank_code' => 'string',
        'data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|integer',
        'transaction_id' => 'required|integer',
        'bank_code' => 'required|string|max:191',
        'data' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
