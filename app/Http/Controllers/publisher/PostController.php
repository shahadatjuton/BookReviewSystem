<?php

namespace App\Http\Controllers\publisher;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\publisher\PostApproval;
use App\Notifications\AdminNotification;
use App\Notifications\NotifyAdmin;
use App\Notifications\SubscriberNotification;
use App\Post;
use App\Subscriber;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('publisher.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('publisher.post.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'title'=>'required|max:255',
            'image'=>'image|mimes:jpeg,bmp,png,jpg|max:5140',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
            'quantity'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',



        ]);

        $image = $request->file('image');
        $slug = str::slug($request->title);

        if (isset($image)) {

            $currant_date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('post')) {

                Storage::disk('public')->makeDirectory('post');

            }

            $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('post/'.$image_name,$imageSize);

        }else {

            $image_name="default.png";
        }

        $post =new Post();
        $post->user_id= Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$image_name;
        $post->quantity = $request->quantity;
        $post->price = $request->price;
        $post->body=$request->body;
//        if (isset($request->status)) {
//            $post->status=true;
//        }else {
//            $post->status=false;
//
//        }
        $post->status=false;
        $post->save();

//        $subscribers = Subscriber::all();
//        foreach ($subscribers as $subscriber) {
//            Notification::send($subscriber, new SubscriberNotification($post));
//
//        }
        $users=User::where('role_id','1')->get();
        Notification::send($users, new NotifyAdmin($post));

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);


//        Mail sending to admin for approval

//        $users = User::where('role_id','1')->get();
//
//       Mail::to($users)->send(new \App\Mail\PostApproval($post));




//        Notification::send($users, new AdminNotification($post));

        Toastr::success('Category  Created successfully', 'success');
        return redirect()->route('publisher.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post->user_id != Auth::id()) {
            Toastr::error('you are not eligible to access it','Error');
            return redirect()->back();
        }
        return view('publisher.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if ($post->user_id != Auth::id()) {
            Toastr::error('you are not eligible to access it','Error');
            return redirect()->back();
        }

        $categories =Category::all();
        $tags =Tag::all();

        return view('publisher.post.edit', compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post->user_id != Auth::id()) {
            Toastr::error('you are not eligible to access it','Error');
            return redirect()->back();
        }

        if ($post->user_id != Auth::id()) {
            Toastr::error('you are not eligible to access it','Error');
            return redirect()->back();
        }
        $post = Post::find($id);

        $this->validate($request,[

            'title'=>'required|max:255',
            'image'=>'image|mimes:jpeg,bmp,png,jpg|max:5140',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
            'quantity'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',


        ]);

        $image = $request->file('image');
        $slug = str::slug($request->title);

        if (isset($image)) {

            $currant_date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('post')) {

                Storage::disk('public')->makeDirectory('post');

            }

            if (Storage::disk('public')->exists('post/'. $post->image )) {

                Storage::disk('public')->delete('post/'. $post->image );

            }

            $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('post/'.$image_name,$imageSize);

        }else {

            $image_name=$post->image ;
        }

        $post->user_id = Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$image_name;
        $post->quantity = $request->quantity;
        $post->price = $request->price;
        $post->body=$request->body;
        $post->status = false;
        $post->save();


        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Category  Updated successfully', 'success');
        return redirect()->route('publisher.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);
        if ($post->user_id != Auth::id()) {
            Toastr::error('you are not eligible to access it','Error');
            return redirect()->back();
        }

        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();


        $post->delete();
        toastr::success('Data is deleted successfully!!','success');
        return redirect()->back();

    }
}
