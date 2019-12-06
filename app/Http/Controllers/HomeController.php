<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Category;
use App\Post;
use App\Rating;
use App\Tag;
use App\UserRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $posts =Post::where('status', 1)->latest()->get();
        $tags = Tag::all();
        $categories = Category::all();
//        $popular_posts = Post::popular()->get();
        $popular_posts = Post::withCount('favourite_to_users')
            ->withCount('comments')
            ->orderBy('view_count','desc')
            ->orderBy('favourite_to_users_count','desc')
            ->orderBy('comments_count','desc')
            ->get();
 $randomblog =BlogPost::all()->random(2);
        return view('welcome',compact(['posts', 'tags', 'categories','popular_posts','randomblog']));
    }


    public function about_us()
    {
        $randomPost = Post::all()->random(1);
        return view('about',compact('randomPost'));
    }




    public function publisherRequest()
    {

        return view('UserRequest');
    }

    public function publisherRequestStore( Request $request, $id)
    {
        $this->validate($request,[

            'description'=>'required',

        ]);

        $userRequest = new UserRequest();
        $userRequest->description = $request->description;
        $userRequest->user_id = $id;
        $userRequest->save();

        Toastr::success('your request sent successfully', 'success');
        return redirect()->back();


    }

}
