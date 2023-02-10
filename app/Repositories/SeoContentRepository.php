<?php

namespace App\Repositories;

use App\Models\SeoContent;
use App\Repositories\BaseRepository;

/**
 * Class SeoContenRepository
 * @package App\Repositories
 * @version April 1, 2021, 11:37 am +07
*/

class SeoContentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'entity_id',
        'entity_type',
        'meta_title',
        'meta_keyword',
        'meta_des'
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
        return SeoContent::class;
    }
}
