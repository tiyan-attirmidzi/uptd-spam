<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const UNPAID_OFF = 0;
    const ALREADY_PAID = 1;
    const DATE_INPUT_EARLY = 1;
    const DATE_INPUT_FINAL = 5;
    const DATE_PAY_EARLY = 6;
    const DATE_PAY_FINAL = 20;

    protected $fillable = [
        'admin_fee',
        'usage',
        'usage_cost',
        'fine',
        'total_payment',
        'status',
        'id_customer'
    ];

    protected $hidden = [
        //
    ];

    public function customer() {
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }
}
