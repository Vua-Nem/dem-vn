<?php

namespace App\Repositories;

use App\Models\ProductImage;
use App\Repositories\BaseRepository;

/**
 * Class ProductImageRepository
 * @package App\Repositories
 * @version December 24, 2020, 7:17 am UTC
*/

class ProductImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'path',
        'type',
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
        return ProductImage::class;
    }
}
