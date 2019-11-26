<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    public function blogComment(){
        return $this->belongsTo('App\BlogComment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
