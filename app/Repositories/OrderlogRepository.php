<?php

namespace App\Repositories;

use App\Models\Orderlog;
use App\Repositories\BaseRepository;

/**
 * Class OrderlogRepository
 * @package App\Repositories
 * @version January 7, 2021, 11:12 am UTC
*/

class OrderlogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'content',
        'created_by'
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
        return Orderlog::class;
    }
}
