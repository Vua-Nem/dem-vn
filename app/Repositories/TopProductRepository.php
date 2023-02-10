<?php

namespace App\Repositories;

use App\Models\TopProduct;
use App\Repositories\BaseRepository;

/**
 * Class TopProductRepository
 * @package App\Repositories
 * @version December 29, 2020, 9:37 am UTC
*/

class TopProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'type',
        'group_id',
        'position'
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
        return TopProduct::class;
    }
}
