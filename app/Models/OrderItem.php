<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class OrderItem
 * @package App\Models
 * @version January 8, 2021, 7:01 am UTC
 *
 */
class OrderItem extends Model
{

    use HasFactory;

    public $table = 'order_items';
    



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


    public function productVariant()
    {
        return $this->hasOne(ProductVariant::class, "id", "product_variant_id");
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, "product_id", "product_id");
    }
}
