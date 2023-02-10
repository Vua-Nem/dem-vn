<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PromotionObject
 * @package App\Models
 * @version December 29, 2020, 3:53 am UTC
 *
 * @property integer $promotion_id
 * @property string $object_id
 */
class PromotionObject extends Model
{

    use HasFactory;

    public $table = 'promotion_objects';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'promotion_id',
        'object_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'promotion_id' => 'integer',
        'object_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'promotion_id' => 'required|integer',
        'object_id' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return mixed
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, "promotion_id", "id");
    }
}
