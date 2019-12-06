<?php

namespace App\Http\Controllers\admin;

use App\BlogComment;
use App\Cart;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Order;
use App\Post;
use App\Quote;
use App\Rating;
use App\Role;
use App\Subscriber;
use App\Tag;
use App\User;
use App\UserRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public  function index(){

        $date = \Carbon\Carbon::today()->subDays(30);

        $last_months_users = User::where('created_at', '>=', $date)->count();
        $last_months_posts = Post::where('created_at', '>=', $date)->count();



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
        $new_users = User::whereDate('created_at',Carbon::today()->subDays(30))->count();
        $last_week_users = User::whereDate('created_at',Carbon::now()->subWeek())->count();
        $total_tags = Tag::all()->count();
        $total_categories = Category::all()->count();
        $total_comments = BlogComment::all()->count();
        $total_quotes = Quote::all()->count();
        $total_reviews = Rating::all()->count();
        $total_orders =Order::all()->count();




//            $active_user = User::where('role_id',4)
//            ->withCount('ratings')
//            ->withCount('review_replies')
//            ->withCount('quotes')
//            ->withCount('favourite_to_users')
//            ->orderBy('ratings_count','desc')
//            ->orderBy('review_replies_count','desc')
//            ->orderBy('quotes_count','desc')
//          ->orderBy('favourite_to_users_count','desc')->get();

        return view('admin.dashboard',compact('posts','popular_posts',
            'total_pending_posts','total_view_posts','total_users','new_users','total_tags',
            'total_categories','total_comments','total_quotes','total_reviews','last_week_users',
            'total_orders','last_months_users','last_months_posts'));
    }



    public function userReport()
    {
        $users = User::latest()->get();
        $pdf = PDF::loadView('admin.reports.user', compact('users'));
        return $pdf->stream('user_report.pdf');
    }


    public function PendingPostReport()
    {
        $posts = Post::where('status',false)->latest()->get();
        $pdf = PDF::loadView('admin.reports.pendingPost', compact('posts'));
        return $pdf->stream('pending_post_report.pdf');
    }

    public function FavouritePostReport()
    {
        $posts = Auth::user()->favourite_posts;
        $pdf = PDF::loadView('admin.reports.favourite', compact('posts'));
        return $pdf->stream('favourite_post_report.pdf');
    }

    public function subscriberReport()
    {
        $subscribers = Subscriber::latest()->get();
        $pdf = PDF::loadView('admin.reports.subscriber', compact('subscribers'));
        return $pdf->stream('subscriber_list_report.pdf');
    }



public function publisherRequest()
{
    $user_request =UserRequest::all();
    return view('admin.publisherRequest',compact('user_request'));
}




    public function publisherRequestAccept(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role_id = 2;

        $user->save();

        Toastr::success('The user is assigned as a publisher successfully','success');
        return redirect()->back();
    }

}
