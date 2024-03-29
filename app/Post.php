<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //=============relation with User model=====================

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function categories(){
        return $this->belongsToMany('App\Category')->withTimestamps();
    }


    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function favourite_to_users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function scopePopular($query)
    {
        return $query->where('view_count', '>', 1);
    }
    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function add_to_carts(){
        return $this->belongsToMany('App\Cart')->withTimestamps();
    }

    public function ratings_to_users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function ratings(){
        return $this->hasMany('App\Rating');
    }

}
