<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class District
 * @package App\Models
 * @version January 7, 2021, 10:20 am UTC
 *
 * @property integer $province_id
 * @property string $name
 */
class District extends Model
{

    use HasFactory;

    public $table = 'districts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'province_id',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'province_id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'province_id' => 'required|integer',
        'name' => 'required|string|max:250',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
