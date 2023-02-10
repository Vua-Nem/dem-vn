<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ProductImage
 * @package App\Models
 * @version December 24, 2020, 7:17 am UTC
 *
 * @property integer $product_id
 * @property string $path
 * @property integer $type
 * @property string $name
 */
class ProductImage extends Model
{

    use HasFactory;

    public $table = 'product_images';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PRODUCT_IMAGE_TYPE_IS_DEFAULT = 0;
    const PRODUCT_IMAGE_TYPE_IS_AVATAR = 1;

    public $fillable = [
        'product_id',
        'path',
        'type',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'path' => 'string',
        'type' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|integer',
        'path' => 'required|string|max:500',
        'type' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'name' => 'required|string|max:255'
    ];

    public static $imageType = [
        self::PRODUCT_IMAGE_TYPE_IS_DEFAULT => "Default",
        self::PRODUCT_IMAGE_TYPE_IS_AVATAR => "Ảnh dại diện",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
