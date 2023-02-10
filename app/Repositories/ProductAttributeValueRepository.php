<?php

namespace App\Repositories;

use App\Models\ProductAttributeValue;
use App\Repositories\BaseRepository;

/**
 * Class ProductAttributeValueRepository
 * @package App\Repositories
 * @version December 28, 2020, 2:26 am UTC
*/

class ProductAttributeValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'product_variant_id',
        'attribute_value_id'
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
        return ProductAttributeValue::class;
    }
}
