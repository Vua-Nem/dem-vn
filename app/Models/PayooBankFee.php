<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PayooBankFee
 * @package App\Models
 * @version March 1, 2021, 3:46 am UTC
 *
 * @property integer $bank_id
 * @property integer $level
 * @property integer $month
 * @property float $fee
 */
class PayooBankFee extends Model
{

    use HasFactory;

    public $table = 'payoo_bank_fees';

    public $fillable = [
        'bank_id',
        'level',
        'month',
        'fee',
        'created_at',
        'updated_at',
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
