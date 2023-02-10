<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShortDescription extends Model
{
    use HasFactory;

    public $table = 'product_short_descriptions';

    public $fillable = [
        'product_id',
        'name'
    ];
}
