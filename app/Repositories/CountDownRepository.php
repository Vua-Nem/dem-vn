<?php

namespace App\Repositories;

use App\Models\CountDown;
use App\Repositories\BaseRepository;

/**
 * Class CountDownRepository
 * @package App\Repositories
 * @version April 15, 2021, 2:03 pm +07
*/

class CountDownRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'name',
        'start_date',
        'end_date',
        'status',
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
        return CountDown::class;
    }
}
