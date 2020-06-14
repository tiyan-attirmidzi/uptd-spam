<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherCost extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    protected $hidden = [
        //
    ];
}
