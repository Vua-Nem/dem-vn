<?php

namespace App\Repositories;

use App\Models\ReviewImage;
use App\Repositories\BaseRepository;

/**
 * Class ProductImageRepository
 * @package App\Repositories
 * @version December 24, 2020, 7:17 am UTC
*/

class ReviewImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review_id',
        'path',
        'file_name',
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
        return ReviewImage::class;
    }
}
