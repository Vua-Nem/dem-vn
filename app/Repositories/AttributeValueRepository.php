<?php

namespace App\Repositories;

use App\Models\AttributeValue;
use App\Repositories\BaseRepository;

/**
 * Class AttributeValueRepository
 * @package App\Repositories
 * @version December 16, 2020, 7:44 am UTC
*/

class AttributeValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attribute_id',
        'value'
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
        return AttributeValue::class;
    }
}
