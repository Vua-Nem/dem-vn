<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Orderlog
 * @package App\Models
 * @version January 7, 2021, 11:12 am UTC
 *
 * @property integer $order_id
 * @property string $content
 * @property integer $created_by
 */
class Orderlog extends Model
{

    use HasFactory;

    public $table = 'order_logs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'order_id',
        'content',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'content' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|integer',
        'content' => 'required|string|max:500',
        'created_by' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
