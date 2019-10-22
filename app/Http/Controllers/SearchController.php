<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->keyword;
         $posts = Post::where('title','LIKE',"%$keyword%")->status()->get();
        return view('post.search',compact('posts','keyword'));
    }
}
