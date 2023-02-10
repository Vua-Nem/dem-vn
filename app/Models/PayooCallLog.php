<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PayooCallLog
 * @package App\Models
 * @version February 22, 2021, 10:29 am UTC
 *
 * @property integer $order_no
 * @property string $data
 */
class PayooCallLog extends Model
{

    use HasFactory;

    public $table = 'payoo_call_logs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'order_no',
        'data'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_no' => 'integer',
        'data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_no' => 'required|integer',
        'data' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
