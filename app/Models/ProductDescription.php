<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ProductDescription
 * @package App\Models
 * @version December 24, 2020, 8:37 am UTC
 *
 */
class ProductDescription extends Model
{

    use HasFactory;

    public $table = 'product_descriptions';
    



    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
