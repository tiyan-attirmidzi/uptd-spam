<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptionCost extends Model
{

    protected $fillable = [
        'lower_limit',
        'upper_limit',
        'price',
        'description'
    ];

    protected $hidden = [
        //
    ];



}
