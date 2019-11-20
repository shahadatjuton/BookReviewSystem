<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collecting extends Model
{
    public function categories(){
        return $this->belongsToMany('App\Collecting')->withTimestamps();
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }









}
