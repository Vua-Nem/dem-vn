<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Menu
 * @package App\Models
 * @version December 25, 2020, 2:19 am UTC
 *
 * @property integer $parent_id
 * @property string $name
 * @property integer $position
 * @property string $url
 * @property string $class_name
 * @property string $id_name
 */
class Menu extends Model
{

    use HasFactory;

    public $table = 'menus';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'parent_id',
        'name',
        'position',
        'url',
        'class_name',
        'id_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'name' => 'string',
        'position' => 'integer',
        'url' => 'string',
        'class_name' => 'string',
        'id_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'integer',
        'name' => 'required|string|max:255',
    ];


}
