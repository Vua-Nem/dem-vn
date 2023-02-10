<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\BaseRepository;

/**
 * Class ContactRepository
 */

class ContactRepository extends BaseRepository
{
  /**
   * @var array
   */
  protected $fieldSearchable = [
    'full_name',
    'phone'
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
    return Contact::class;
  }
}
