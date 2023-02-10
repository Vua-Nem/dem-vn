<?php

namespace App\Repositories;

use App\Models\LandingContactForm;
use App\Repositories\BaseRepository;

/**
 * Class LandingContactFormRepository
 * @package App\Repositories
 * @version March 1, 2021, 7:58 am UTC
*/

class LandingContactFormRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'full_name',
        'phone',
        'email',
        'source',
        'note'
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
        return LandingContactForm::class;
    }
}
