<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TmpProduct
 * @package App\Models
 * @version December 21, 2020, 9:17 am UTC
 *
 * @property integer $product_id
 * @property string $sku
 * @property string $content
 */
class TmpProduct extends Model
{

    use HasFactory;

    public $table = 'tmp_products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'product_id',
        'sku',
        'content',
        'product_parent',
        'status',
        'category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'product_parent' => 'string',
        'sku' => 'string',
        'status' => 'string',
        'content' => 'string',
        'category' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|integer',
        'product_parent' => 'string',
        'sku' => 'required|string|max:50',
        'content' => 'required|string',
        'status' => 'required|string',
        'category' => 'string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
