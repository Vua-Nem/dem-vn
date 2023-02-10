<?php

namespace App\Models;

use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AttributeValue
 * @package App\Models
 * @version December 16, 2020, 7:44 am UTC
 *
 * @property integer $attribute_id
 * @property string $code
 * @property string $value
 */
class AttributeValue extends Model
{
    use HasFactory;

    public $table = 'attribute_values';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'attribute_id',
        'code',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'attribute_id' => 'integer',
        'code' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'attribute_id' => 'required|integer',
        'value' => 'required|string|max:255',
        'code' => 'string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

}
