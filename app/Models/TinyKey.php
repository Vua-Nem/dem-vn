<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class tinyKey
 * @package App\Models
 * @version January 21, 2021, 8:23 am UTC
 *
 * @property integer $count_seccsion
 * @property string $api_key
 * @property integer $status
 */
class TinyKey extends Model
{

    use HasFactory;

    public $table = 'tiny_api';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'count_seccsion',
        'api_key',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'count_seccsion' => 'integer',
        'api_key' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'api_key' => 'required|string|max:500',
        'status' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
