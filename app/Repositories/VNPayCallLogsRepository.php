<?php

namespace App\Repositories;

use App\Models\VNPayCallLogs;
use App\Repositories\BaseRepository;

/**
 * Class VNPayCallLogsRepository
 * @package App\Repositories
 * @version January 21, 2021, 9:07 am UTC
*/

class VNPayCallLogsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'transaction_id',
        'bank_code',
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
        return VNPayCallLogs::class;
    }
}
