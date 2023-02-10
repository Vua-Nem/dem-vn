<?php

namespace App\Models;

use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Attribute
 * @package App\Models
 * @version December 16, 2020, 7:41 am UTC
 *
 * @property integer $id
 * @property string $attribute_code
 * @property string $name
 */
class Review extends Model
{

    const REVIEW_IS_ACTIVE = 1;
    const REVIEW_IS_DISABLE = 0;

    public $table = 'reviews';

    public $fillable = [
        'id',
        'user_id',
        'content',
        'status',
        'entity_id',
        'entity_type'
    ];

    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
    ];

    public function getUser()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
    public function categoryEntityValue() {
    }

    public function getProduct() {
        return $this->hasOne(Product::class, "id", "entity_id");
    }

    public function reviewImage()
    {
        return $this->hasOne(ReviewImage::class, "review_id", "id");
    }
}
