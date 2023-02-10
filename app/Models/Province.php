<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Province
 * @package App\Models
 * @version January 7, 2021, 10:20 am UTC
 *
 * @property string $name
 */
class Province extends Model
{

    use HasFactory;

    public $table = 'provinces';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:250',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
