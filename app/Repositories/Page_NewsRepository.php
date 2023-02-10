<?php

namespace App\Repositories;

use App\Models\Page_News;
use App\Repositories\BaseRepository;

/**
 * Class Page_NewsRepository
 * @package App\Repositories
 * @version January 28, 2021, 9:48 am UTC
*/

class Page_NewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'url',
        'path',
        'title',
        'comment',
        'slost',
        'status',
        'type'
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
        return Page_News::class;
    }
}
