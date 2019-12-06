<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function cart_posts(){
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    public function oreder(){
        return $this->belongsTo('App\Order');
    }



}
