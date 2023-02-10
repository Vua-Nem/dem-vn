<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SeoConten
 * @package App\Models
 * @version April 1, 2021, 11:37 am +07
 *
 * @property integer $entity_id
 * @property boolean $entity_type
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_des
 */
class SeoContent extends Model
{
    use HasFactory;

    public $table = 'seo_contents';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const SEO_CATEGORY = 0; //Top sản phẩm bán chạy cho đệm
    const SEO_HOME_PAGE = 1; //Top sản phẩm bán chạy cho chăn ga gối
    const SEO_PRODUCT = 2;
    const SEO_BRAND = 3;
    const SEO_STORE = 4;

    public static $arry_seo_type = [
        self::SEO_CATEGORY => "Category",
        self::SEO_HOME_PAGE => "Home page",
        self::SEO_PRODUCT => "Product",
        self::SEO_BRAND => "Brands",
        self::SEO_STORE => "Store",
    ];


    public $fillable = [
        'entity_id',
        'entity_type',
        'meta_title',
        'meta_keyword',
        'meta_des'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
        'entity_type' => 'integer',
        'meta_title' => 'string',
        'meta_keyword' => 'string',
        'meta_des' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'entity_id' => 'required|integer',
        'entity_type' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
