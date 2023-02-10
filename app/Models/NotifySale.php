<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class NotifySale
 * @package App\Models
 * @version April 16, 2021, 9:54 am +07
 *
 * @property integer $product_id
 * @property string $notify_title
 * @property string $notify_des
 */
class NotifySale extends Model
{

    use HasFactory;

    public $table = 'notify_sales';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

	const ACTIVE = 1;
	const DEACTIVATE = 2;

	public static $status = [
		self::ACTIVE => 'Active',
		self::DEACTIVATE => 'Deactivate',
	];


    public $fillable = [
        'product_id',
        'notify_title',
        'notify_des',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'notify_title' => 'string',
        'notify_des' => 'string',
		'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|integer',
        'notify_title' => 'required|string|max:1000',
        'notify_des' => 'required|string',
        'status' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
