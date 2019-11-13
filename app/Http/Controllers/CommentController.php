<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Rating;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $post)
    {
      $this->validate( $request, [
         'comment'=> 'required'
      ]);

      $comment = new Comment();

      $comment->post_id =$post;
      $comment->user_id = Auth::id();
      $comment->comment = $request->comment;
      $comment->save();
      Toastr::success('Comment submitted successfully','success');
      return redirect()->back();




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rating(Request $request) {
        $post_id = $request->post_id;
        $user = Auth::user();
        $rated = $user->rating_posts()->where('post_id',$post_id)->count();
        if ($rated > 0 ){
            Toastr::success('This book is already rated','Success');
            return redirect()->back();
        }else{
        $rating = new Rating();
        $rating->post_id = $request->post_id;
        $rating->user_id = $user->id;
        $rating->rating_star = $request->rating;
        $rating->review = $request->review;
        $rating->save();

        Toastr::success('Thank you for rating','success');
        return redirect()->back();

        }
    }
}
