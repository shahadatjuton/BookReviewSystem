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


// ===============All - Posts ==============================

    public function index()
    {
        $posts =Post::simplePaginate(9);

        $categories = Category::all();
        return view('post.posts', compact('posts','categories'));
    }

    public function bookCategory($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $categories = Category::all();
        return view('post.books',compact('category','categories'));
    }


// ===============Tag wis post ==============================


//    public function tagPost($slug)
//    {
//        $tag = Tag::where('slug',$slug)->first();
//        return view('post.tag_post',compact('tag'));
//    }
//



// ===============Category wise post ==============================

public function CategoryPost($slug)
{
      $category = Category::where('slug',$slug)->first();
      return view('post.category_post',compact('category'));
}


// ===============Tag wis post ==============================


    public function tagPost($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        return view('post.tag_post',compact('tag'));
    }





}
