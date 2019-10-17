<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostDetailsController extends Controller
{
    public function details($slug)
    {
       $post = Post::where('slug',$slug)->first();

       $viewCount = 'count_'.$post->id;
       if (!Session::has($viewCount))
       {
           $post->increment('view_count');
           Session::put($viewCount,1);
       }

       $randomPost = Post::all()->random(3);
        return view('PostDetails',compact('post','randomPost'));
    }
}
