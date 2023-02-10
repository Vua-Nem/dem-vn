<?php

namespace App\Repositories;

use App\Models\OrderVoucher;
use App\Repositories\BaseRepository;

/**
 * Class OrderVoucherRepository
 * @package App\Repositories
 * @version February 24, 2021, 8:09 am UTC
*/

class OrderVoucherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'voucher_id',
        'voucher_discount_type',
        'voucher_discount_value',
        'voucher_created_by',
        'voucher_start_date',
        'voucher_end_date'
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
        return OrderVoucher::class;
    }
}
