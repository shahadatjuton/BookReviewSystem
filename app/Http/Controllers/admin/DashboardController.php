<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public  function index(){


        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
            ->withCount('favourite_to_users')
           ->orderBy('view_count','desc')
           ->orderBy('favourite_to_users_count','desc')
           ->orderBy('comments_count','desc')
            ->get();

        $total_pending_posts = Post::where('status',0)->count();
        $total_view_posts = Post::sum('view_count');
        $total_users = User::all()->count();
        $new_users = User::whereDate('created_at', Carbon::today())->count();
        $total_tags = Tag::all()->count();
        $total_categories = Category::all()->count();
        $total_comments = Comment::all()->count();

        return view('admin.dashboard',compact('posts','popular_posts',
            'total_pending_posts','total_view_posts','total_users','new_users','total_tags',
            'total_categories','total_comments'));
    }
}
