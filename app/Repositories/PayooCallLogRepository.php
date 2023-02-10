<?php

namespace App\Repositories;

use App\Models\PayooCallLog;
use App\Repositories\BaseRepository;

/**
 * Class PayooCallLogRepository
 * @package App\Repositories
 * @version February 22, 2021, 10:29 am UTC
*/

class PayooCallLogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_no',
        'data'
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
        return PayooCallLog::class;
    }
}
