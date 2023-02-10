<?php

namespace App\Repositories;

use App\Models\NotifySale;
use App\Repositories\BaseRepository;

/**
 * Class NotifySaleRepository
 * @package App\Repositories
 * @version April 16, 2021, 9:54 am +07
*/

class NotifySaleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'notify_title',
        'notify_des'
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
        return NotifySale::class;
    }
}
