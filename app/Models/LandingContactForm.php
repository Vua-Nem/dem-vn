<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class LandingContactForm
 * @package App\Models
 * @version March 1, 2021, 7:58 am UTC
 *
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string $source
 * @property string $note
 */
class LandingContactForm extends Model
{

    use HasFactory;

    public $table = 'landing_contact_forms';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'full_name',
        'phone',
        'email',
        'source',
        'note',
        'campain'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'full_name' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'source' => 'string',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'full_name' => 'required|string|max:250',
        'phone' => 'required|string|max:50',
        'email' => 'required|string|max:150',
        'source' => 'required|string|max:191',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
