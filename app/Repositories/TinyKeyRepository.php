<?php

namespace App\Repositories;

use App\Models\TinyKey;
use App\Repositories\BaseRepository;

/**
 * Class tinyKeyRepository
 * @package App\Repositories
 * @version January 21, 2021, 8:23 am UTC
*/

class TinyKeyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'count_seccsion',
        'api_key',
        'status'
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
        return TinyKey::class;
    }
}
