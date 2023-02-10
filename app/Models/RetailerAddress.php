<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RetailerAddress
 * @package App\Models
 * @version June 10, 2021, 11:32 am +07
 *
 * @property integer $entity_id
 * @property string $address
 * @property string $slug
 * @property string $name
 * @property string $postcode
 * @property string $latitude
 * @property string $longitude
 * @property string $phone_store
 * @property string $extension_number
 * @property integer $province_id
 * @property integer $district_id
 * @property boolean $status
 * @property string $opening_time
 */
class RetailerAddress extends Model
{

	use HasFactory;

	public $table = 'smile_retailer_address';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	const STORE_IS_AVAILABLE = 1;
	const STORE_IS_NOT_AVAILABLE = 0;



	public $fillable = [
		'address',
		'postcode',
		'slug',
		'name',
		'latitude',
		'longitude',
		'phone_store',
		'extension_number',
		'province_id',
		'district_id',
		'status',
		'opening_time'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'address' => 'string',
		'postcode' => 'string',
		'latitude' => 'string',
		'longitude' => 'string',
		'phone_store' => 'string',
		'extension_number' => 'string',
		'province_id' => 'integer',
		'district_id' => 'integer',
		'opening_time' => 'string'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'address' => 'required|string',
		'postcode' => 'required|string|max:191',
		'latitude' => 'required|string|max:191',
		'longitude' => 'required|string|max:191',
		'phone_store' => 'required|string|max:191',
		'province_id' => 'required|integer',
		'district_id' => 'required|integer',
		'opening_time' => 'required|string|max:191',
		'created_at' => 'nullable',
		'updated_at' => 'nullable'
	];

	public function province()
	{
		return $this->hasOne(Province::class, "id", "province_id");
	}

	public function districts()
	{
		return $this->hasOne(District::class, "id", "district_id");
	}
    
}
