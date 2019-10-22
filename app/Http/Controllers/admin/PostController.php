<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\NotifySubscriber;
use App\Notifications\PublisherNotification;
use App\Notifications\SubscriberNotification;
use App\Post;
use App\Subscriber;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
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

        return view('admin.post.create', compact('categories','tags'));
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

            'title'=>'required',
            'image'=>'mimes:jpeg,bmp,png,jpg',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
            'quantity'=>'required',


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
        $post->body=$request->body;
//        if (isset($request->status)) {
//            $post->status=true;
//        }else {
//            $post->status=false;
//
//        }
        $post->status=true;
        $post->save();

//        $subscribers =Subscriber::all();
//        foreach ($subscribers as $subscriber)
//        {
//            Notification::route('mail',$subscriber->email)->notify(new NotifySubscriber($post));
//        }

//        $subscribers = Subscriber::all();
//        foreach ($subscribers as $subscriber)
//        {
////            Notification::route('mail',$subscriber->email)->notify(new SubscriberNotification($post));
//            Notification::send('mail',$subscriber->email)
//                ->notify(new SubscriberNotification($post));
//
//        }


        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Category  Created successfully', 'success');
        return redirect()->route('admin.post.index');
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
//        if ($post->user_id != Auth::id()) {
//            Toastr::error('you are not eligible to access it','Error');
//            return redirect()->back();
//        }
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories =Category::all();
        $tags =Tag::all();
        $post = Post::find($id);
        return view('admin.post.edit', compact('categories','tags','post'));
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

//
//        if ($post->user()->id !== Auth::user_id) {
//            toastr::danger('you are not eligible to access it','danger');
//        }

        $this->validate($request,[

            'title'=>'required',
            'image'=>'image',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
            'quantity'=>'required',


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
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $image_name;
        $post->quantity = $request->quantity;
        $post->body = $request->body;
        $post->status = true;
        $post->save();


        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Category  Updated successfully', 'success');
        return redirect()->route('admin.post.index');

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
        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();


        $post->delete();
        toastr::success('Data is deleted successfully!!','success');
        return redirect()->back();
    }


    /**
     *  Show pending post
     */
    public function pending()
    {
        $posts = Post::where('status',false)->latest()->get();
        return view('admin.post.pending',compact('posts'));
    }

    /**
     *  approve the  pending post
     */
    public function approve($id)
    {
        $pendingPost=Post::find($id);

        if($pendingPost->status == false)
        {
            $pendingPost->status=true;
            $pendingPost->save();

            $pendingPost->user->notify(new PublisherNotification($pendingPost));

            $subscribers = Subscriber::all();

            Mail::to($subscribers)->send(new NotifySubscriber($pendingPost));


            toastr::success('Your post is approved successfully','success');
        }else{
            Toastr::Info('Your post is already approved','info');

        }
        return redirect()->back();
    }



}
