<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PayooIpnErrorLog
 * @package App\Models
 * @version March 2, 2021, 7:38 am UTC
 *
 * @property integer $order_id
 * @property string $error
 */
class PayooIpnErrorLog extends Model
{

    use HasFactory;

    public $table = 'payoo_ipn_error_logs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'order_id',
        'error'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'error' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|integer',
        'error' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
