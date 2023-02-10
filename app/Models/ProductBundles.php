<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ProductBundles
 * @package App\Models
 * @version April 26, 2021, 9:31 am +07
 *
 * @property integer $product_id
 * @property integer $product_attach_id
 * @property integer $product_attach_price
 */
class ProductBundles extends Model
{

    use HasFactory;

    public $table = 'product_bundles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'product_id',
        'product_attach_id',
        'product_attach_price',
        'quantity_number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'product_attach_id' => 'string',
        'product_attach_price' => 'integer',
        'quantity_number' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|integer',
        'product_attach_id' => 'required|string',
        'product_attach_price' => 'required|integer',
        'quantity_number' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
