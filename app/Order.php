<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function payment_methods()
    {
        return $this->belongsTo('App\PaymentMethod');
    }

    public function carts(){
        return $this->hasMany('App\Cart');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }





}
