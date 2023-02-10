<?php

namespace App\Repositories;

use App\Models\Orders;
use App\Repositories\BaseRepository;

/**
 * Class OrdersRepository
 * @package App\Repositories
 * @version January 7, 2021, 10:43 am UTC
*/

class OrdersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'user_name',
        'phone_number',
        'province_id',
        'district_id',
        'address',
        'description',
        'amount',
        'real_amount',
        'created_by',
        'status',
        'payment_method',
        'payment_status'
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
        return Orders::class;
    }
}
