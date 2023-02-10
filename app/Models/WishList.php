<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class WishList
 * @package App\Models
 * @version May 25, 2021, 9:59 am +07
 *
 * @property string $phone_number
 * @property string $email
 * @property string $full_name
 * @property integer $province_id
 * @property integer $district_id
 * @property string $address
 * @property string $oder_item
 * @property boolean $status_telegram
 * @property integer $time_send_telegram
 */
class WishList extends Model
{

    use HasFactory;

    public $table = 'wish_lists';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

	const WID_LIST_CRON_STATUS_IS_NEW = 1;
	const WID_LIST_CRON_STATUS_IS_DONE = 2;


    public $fillable = [
        'phone_number',
        'email',
        'full_name',
        'province_id',
        'district_id',
        'address',
        'oder_item',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'phone_number' => 'string',
        'email' => 'string',
        'full_name' => 'string',
        'province_id' => 'integer',
        'district_id' => 'integer',
        'address' => 'string',
        'oder_item' => 'string',
        'status_telegram' => 'integer',
        'time_send_telegram' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'phone_number' => 'required|string|max:50',
        'email' => 'nullable|string|max:50',
        'full_name' => 'nullable|string|max:50',
        'province_id' => 'nullable|integer',
        'district_id' => 'nullable|integer',
        'address' => 'nullable|string|max:250',
        'oder_item' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
