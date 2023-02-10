<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PayooBank
 * @package App\Models
 * @version March 1, 2021, 3:30 am UTC
 *
 * @property string $bank_code
 * @property string $bank_name
 */
class PayooBank extends Model
{

    use HasFactory;

    public $table = 'payoo_banks';

    public $fillable = [
        'bank_code',
        'bank_name',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
}
