<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\BaseRepository;

/**
 * Class BannerRepository
 * @package App\Repositories
 * @version January 27, 2021, 7:08 am UTC
*/

class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'path',
        'title',
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
        return Banner::class;
    }
}
