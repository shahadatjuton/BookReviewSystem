<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
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
        return view('post.PostDetails',compact('post','randomPost'));
    }




    public function index(Request $request)
    {
        $posts =Post::all();
        return view('post.posts', compact('posts'));
    }

public function CategoryPost($slug)
{
       $category = Category::where('slug',$slug)->first();
      return view('post.category_post',compact('category'));
}


    public function tagPost($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        return view('post.tag_post',compact('tag'));
    }





}
