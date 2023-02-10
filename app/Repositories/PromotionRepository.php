<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\BaseRepository;

/**
 * Class PromotionRepository
 * @package App\Repositories
 * @version December 29, 2020, 2:07 am UTC
*/

class PromotionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'promotion_type',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'min_quantity_item',
        'start_date',
        'end_date',
        'status'
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
        return Promotion::class;
    }
}
