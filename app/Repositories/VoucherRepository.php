<?php

namespace App\Repositories;

use App\Models\Voucher;
use App\Repositories\BaseRepository;

/**
 * Class VoucherRepository
 * @package App\Repositories
 * @version February 24, 2021, 4:18 am UTC
*/

class VoucherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'voucher_type',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'min_quantity_item',
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
        return Voucher::class;
    }
}
