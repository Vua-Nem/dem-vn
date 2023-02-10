<?php

namespace App\Repositories;

use App\Models\ProductBundles;
use App\Repositories\BaseRepository;

/**
 * Class ProductBundlesRepository
 * @package App\Repositories
 * @version April 26, 2021, 9:31 am +07
*/

class ProductBundlesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'product_attach_id',
        'product_attach_price'
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
        return ProductBundles::class;
    }
}
