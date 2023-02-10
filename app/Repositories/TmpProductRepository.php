<?php

namespace App\Repositories;

use App\Models\TmpProduct;
use App\Repositories\BaseRepository;

/**
 * Class TmpProductRepository
 * @package App\Repositories
 * @version December 21, 2020, 9:17 am UTC
*/

class TmpProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'sku',
        'content'
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
        return TmpProduct::class;
    }
}
