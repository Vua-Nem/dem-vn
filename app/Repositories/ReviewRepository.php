<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\BaseRepository;

/**
 * Class BannerRepository
 * @package App\Repositories
 * @version January 27, 2021, 7:08 am UTC
*/

class ReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'defaut_img',
        'entity_id',
        'content',
        'status',
        'entity_type'
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
        return Review::class;
    }

}
