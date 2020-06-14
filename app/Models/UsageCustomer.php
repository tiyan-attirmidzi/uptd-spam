<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsageCustomer extends Model
{
    protected $fillable = [
        'id_customer',
        'total_overall'
    ];

    protected $hidden = [
        //
    ];

    public function customer() {
        return $this->hasOne('App\Models\Customer');
    }
}
