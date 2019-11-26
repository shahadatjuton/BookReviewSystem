<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    public function post(){
        return $this->belongsTo('App\BlogPost');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function blogCommentReplies(){
        return $this->hasMany('App\CommentReply');
    }

}
