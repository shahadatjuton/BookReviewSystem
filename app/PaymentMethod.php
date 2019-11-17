<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function payment_method()
    {
        return $this->hasMany('App\Order');
    }
}
