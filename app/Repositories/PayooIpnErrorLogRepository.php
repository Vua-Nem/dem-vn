<?php

namespace App\Repositories;

use App\Models\PayooIpnErrorLog;
use App\Repositories\BaseRepository;

/**
 * Class PayooIpnErrorLogRepository
 * @package App\Repositories
 * @version March 2, 2021, 7:38 am UTC
*/

class PayooIpnErrorLogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'error'
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
        return PayooIpnErrorLog::class;
    }
}
