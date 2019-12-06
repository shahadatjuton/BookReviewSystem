<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewReply extends Model
{
    public function rating(){
        return $this->belongsTo('App\Rating');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
