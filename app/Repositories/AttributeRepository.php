<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\BaseRepository;

/**
 * Class AttributeRepository
 * @package App\Repositories
 * @version December 16, 2020, 7:41 am UTC
*/

class AttributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attribute_code',
        'name'
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
        return Attribute::class;
    }
}
