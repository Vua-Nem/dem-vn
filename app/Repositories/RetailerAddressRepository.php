<?php

namespace App\Repositories;

use App\Models\RetailerAddress;
use App\Repositories\BaseRepository;

/**
 * Class RetailerAddressRepository
 * @package App\Repositories
 * @version June 10, 2021, 11:32 am +07
*/

class RetailerAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'entity_id',
        'address',
        'slug',
        'name',
        'postcode',
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RetailerAddress::class;
    }
}
