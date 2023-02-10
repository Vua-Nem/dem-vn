<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CountDown
 * @package App\Models
 * @version April 15, 2021, 2:03 pm +07
 *
 * @property string $title
 * @property string $name
 * @property integer $start_date
 * @property integer $end_date
 * @property integer $status
 * @property integer $created_by
 */
class CountDown extends Model
{

    use HasFactory;

    public $table = 'count_downs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

	const ACTIVE = 1;
	const DEACTIVATE = 0;

	public static $status = [
		self::ACTIVE => 'Active',
		self::DEACTIVATE => 'Deactivate',
	];




	const COUNT_DOWN_HOME_PAGE = 1; //Top sản phẩm bán chạy cho chăn ga gối
	const COUNT_DOWN_PRODUCT = 2; //Top sản phẩm bán chạy cho phụ kiện

	public static $arry_count_down_type = [
		self::COUNT_DOWN_HOME_PAGE => "Home page",
		self::COUNT_DOWN_PRODUCT => "Product",
	];


    public $fillable = [
        'entity_id',
        'entity_type',
        'title',
        'name',
        'start_date',
        'end_date',
        'status',
        'start_hour',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
        'title' => 'string',
        'name' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
        'status' => 'integer',
        'start_hour' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'entity_id' => 'required',
        'title' => 'required|string|max:250',
        'name' => 'required|string|max:250',
        'start_date' => 'required',
        'end_date' => 'required',
        'status' => 'required|integer',
		'created_at' => 'nullable',
		'updated_at' => 'nullable'
    ];

    
}
