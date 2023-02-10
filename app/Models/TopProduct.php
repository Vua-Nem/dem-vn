<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TopProduct
 * @package App\Models
 * @version December 29, 2020, 9:37 am UTC
 *
 * @property integer $product_id
 * @property boolean $type
 * @property integer $group_id
 * @property integer $position
 */
class TopProduct extends Model
{

    use HasFactory;

    public $table = 'top_products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'product_id',
        'type',
        'group_id',
        'position'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'type' => 'boolean',
        'group_id' => 'integer',
        'position' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|integer',
        'type' => 'required|boolean',
        'group_id' => 'required|integer',
        'position' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
