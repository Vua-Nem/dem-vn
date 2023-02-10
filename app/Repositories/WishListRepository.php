<?php

namespace App\Repositories;

use App\Models\WishList;
use App\Repositories\BaseRepository;

/**
 * Class WishListRepository
 * @package App\Repositories
 * @version May 25, 2021, 9:59 am +07
*/

class WishListRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'phone_number',
        'email',
        'full_name',
        'province_id',
        'district_id',
        'address',
        'oder_item',
        'status_telegram',
        'time_send_telegram'
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
        return WishList::class;
    }
}
