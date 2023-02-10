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
class ReviewImage extends Model
{
    public $table = 'reviews_images';
    public $fillable = [
        'review_id',
        'path',
        'file_name'
    ];
}