<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //=============relation with role model=====================

    public function role(){
        return $this->belongsTo(Role::class);
    }

    //=============relation with Post model=====================

    public function posts(){
        return $this->hasMany('App\Post');

    }

    public function favourite_posts(){
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
    public function comments(){
        return $this->hasMany('App\Comment')->withTimestamps();
    }

    public function BlogPosts(){
        return $this->hasMany('App\BlogPost');

    }

    public function BlogComments(){
        return $this->hasMany('App\BlogComment');

    }


}
