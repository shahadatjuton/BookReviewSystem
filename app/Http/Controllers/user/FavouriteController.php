<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->favourite_posts()->orderBy('id', 'DESC')->get();
        return view('user.favourite',compact('posts'));
    }
}
