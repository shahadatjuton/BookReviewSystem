<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function BlogComments(){
        return $this->hasMany('App\BlogComment');
    }
}
