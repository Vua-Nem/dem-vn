<?php

namespace App\Repositories;

use App\Models\ProductShortDescription;
use App\Repositories\BaseRepository;

/**
 * Class ProductShortDescription
 * @package App\Repositories
 */

class ProductShortDescriptionRepository extends BaseRepository
{
  /**
   * @var array
   */
  protected $fieldSearchable = [
    'product_id',
    'name'
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
    return ProductShortDescription::class;
  }
}
