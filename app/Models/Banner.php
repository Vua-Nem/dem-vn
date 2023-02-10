<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Banner
 * @package App\Models
 * @version January 27, 2021, 7:08 am UTC
 *
 * @property string $description
 * @property string $url
 * @property string $name
 * @property string $path
 * @property string $title
 * @property integer $slost
 * @property integer $status
 * @property integer $type
 * @property integer $is_mobile
 */
class Banner extends Model
{

    use HasFactory;

    public $table = 'banner_homepage';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const BANNER_IS_WEBSITE = 1;
    const BANNER_IS_MOBILE_WEB = 2;

    const BANNER_IS_ACTIVE = 1;
    const BANNER_IS_NOT_ACTIVE = 0;

    const BANNER_HOME = 0;
    const BANNER_CATEGORY_DETAIL = 1;

    public static $ariStatusName = [
		self::BANNER_IS_ACTIVE => 'Active',
		self::BANNER_IS_NOT_ACTIVE => 'Deactive',
	];


    public $fillable = [
        'url',
        'name',
        'path',
        'title',
        'slost',
        'status',
        'type',
        'description',
        'is_mobile',
        'time_start',
        'time_end'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url'=> 'string',
        'name' => 'string',
        'path' => 'string',
        'title' => 'string',
        'slost' => 'integer',
        'status' => 'integer',
        'type' => 'integer',
        'is_mobile' => 'integer',
        'description'=> 'string',
        'time_start'=>'integer',
        'time_end' =>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'required',
        'title' => 'required|string|max:255',
        'slost' => 'required',
        'status' => 'required',
        'type' => 'required',
        'time_start' => 'nullable',
        'time_end' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

}
