<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }
}
