<?php

namespace App\Repositories;

use App\Models\PromotionObject;
use App\Repositories\BaseRepository;

/**
 * Class PromotionObjectRepository
 * @package App\Repositories
 * @version December 29, 2020, 3:53 am UTC
*/

class PromotionObjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'promotion_id',
        'object_id'
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
        return PromotionObject::class;
    }
}
