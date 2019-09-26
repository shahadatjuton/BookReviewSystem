<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //=============relation with Users model=====================
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
