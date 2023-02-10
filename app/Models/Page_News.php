<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Page_News
 * @package App\Models
 * @version January 28, 2021, 9:48 am UTC
 *
 * @property string $name
 * @property string $url
 * @property string $path
 * @property string $title
 * @property string $comment
 * @property integer $slost
 * @property integer $status
 * @property integer $type
 */
class Page_News extends Model
{

    use HasFactory;

    public $table = 'blog_news';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PAGE_NEW_STATUS_IS_ACTIVE = 1; //Trạng thái đang hoạt đông


    public $fillable = [
        'name',
        'url',
        'path',
        'title',
        'comment',
        'slost',
        'status',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'url' => 'string',
        'path' => 'string',
        'title' => 'string',
        'comment' => 'string',
        'slost' => 'integer',
        'status' => 'integer',
        'type' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'nullable|string|max:500',
        'title' => 'required|string|max:191',
        'comment' => 'required|string|max:200',
        'slost' => 'required|integer',
        'status' => 'required|integer',
        'type' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
