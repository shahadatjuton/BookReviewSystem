<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware(['auth','verified']);
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts =Post::status()->latest()->get();
        $tags = Tag::all();
        $categories = Category::all();
        $popular_posts = Post::popular()->get();

        return view('welcome',compact(['posts', 'tags', 'categories','popular_posts']));
    }


}
