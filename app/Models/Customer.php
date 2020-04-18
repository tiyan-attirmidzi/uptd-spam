<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'billing_number',
        'name',
        'address',
        'connection_status'
    ];

    protected $hidden = [
        //
    ];


}
