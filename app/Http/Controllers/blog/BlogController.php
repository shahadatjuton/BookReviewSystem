<?php

namespace App\Http\Controllers\blog;

use App\BlogComment;
use App\BlogPost;
use App\Comment;
use App\CommentReply;
use App\Http\Controllers\Controller;
use App\Post;
use App\Quote;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index()
    {
        $quotes =Quote::all()->random(2);
        $sidepost =Post::all()->random(2);
       $post = BlogPost::simplepaginate(10);
       return view('blog.blog',compact('post','quotes','sidepost'));
    }

    public function singleblog(Request $request, $slug)
    {

        $post = BlogPost::where('slug',$slug)->first();
        $randomPost = BlogPost::all()->random(2);

        return view('blog.SingleBlog',compact('post','randomPost'));
    }

    public function create ()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'title'=>'required',
            'image'=>'mimes:jpeg,bmp,png,jpg',
//            'categories'=>'required',
//            'tags'=>'required',
            'description'=>'required',


        ]);

        $image = $request->file('image');
        $slug = str::slug($request->title);

        if (isset($image)) {

            $currant_date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('blog')) {

                Storage::disk('public')->makeDirectory('blog');
            }

            $imageSize=Image::make($image)->resize(1900,1266)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('blog/'.$image_name,$imageSize);

        }else {

            $image_name="default.png";
        }

        $post =new BlogPost();
        $post->user_id= Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$image_name;
        $post->description=$request->description;
        $post->save();
//        $post->categories()->attach($request->categories);
//        $post->tags()->attach($request->tags);

        Toastr::success('Post created successfully', 'success');
        return redirect()->route('blog.index');
    }

    public function commentstore(Request $request , $post)
    {
        $this->validate( $request, [
            'comment'=> 'required'
        ]);

        $comment = new BlogComment();

        $comment->blog_post_id =$post;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        Toastr::success('Comment submitted successfully','success');
        return redirect()->back();

    }



    public function replystore(Request $request , $comment)
    {
//        $comment = BlogComment::findOrFail($comment);

        $this->validate( $request, [
            'blogCommenReply'=> 'required'
        ]);

        $commentReply = new CommentReply();

         $commentReply->blog_comment_id =$comment;
         $commentReply->user_id = Auth::id();
        $commentReply->reply = $request->blogCommenReply;
        $commentReply->save();
        Toastr::success('Reply submitted successfully','success');
        return redirect()->back();

    }















}
