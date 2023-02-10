<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'id',
        'name',
        'parent_id',
        'slug',
        'parent_path',
        'children_path',
        'description'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
