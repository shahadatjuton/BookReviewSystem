<?php

namespace App\Http\Controllers\publisher;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public  function index(){

        $user = Auth::user();
        $total_posts = $user->posts();
        $pending_posts = $total_posts->where('status', 0)->count();
        $view_count = $user->posts()->sum('view_count');

        return view('publisher.dashboard',compact('total_posts','view_count','pending_posts'));
    }
}
