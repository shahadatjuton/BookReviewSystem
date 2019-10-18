<?php

namespace App\Http\Controllers\publisher;

use App\Comment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('publisher.post.comments',compact('posts'));
    }

    public function destroy (Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Toastr::success('Selected comment has been deleted','success');
        return redirect()->back();
    }
}
