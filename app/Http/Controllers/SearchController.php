<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function bookSearch(Request $request)
    {
        $keyword = $request->keyword;
         $posts = Post::where('title','LIKE',"%$keyword%")
             ->orWhere('body','LIKE',"%$keyword%")
             ->status()->get();

        return view('post.search',compact('posts','keyword'));
    }


    public function blogSearch(Request $request)
    {
        $keyword = $request->keyword;
        $posts = BlogPost::where('title','LIKE',"%$keyword%")
            ->orWhere('description','LIKE',"%$keyword%")->get();
        return view('blog.search',compact('posts','keyword'));
    }








}
