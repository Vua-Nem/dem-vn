<?php

namespace App\Repositories;

use App\Models\ProductVariant;
use App\Repositories\BaseRepository;

/**
 * Class ProductVariantRepository
 * @package App\Repositories
 * @version December 22, 2020, 9:16 am UTC
*/

class ProductVariantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'name',
        'slug',
        'sku',
        'price',
        'compare_price',
        'qty'
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
        return ProductVariant::class;
    }
}
