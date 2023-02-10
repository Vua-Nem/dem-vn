<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\BaseRepository;

/**
 * Class MenuRepository
 * @package App\Repositories
 * @version December 25, 2020, 2:19 am UTC
*/

class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'name',
        'position',
        'url',
        'class_name',
        'id_name'
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
        return Menu::class;
    }
}
