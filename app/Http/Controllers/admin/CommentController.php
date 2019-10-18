<?php

namespace App\Http\Controllers\admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.post.comments',compact('comments'));
    }

    public function destroy (Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Toastr::success('Selected comment has been deleted','success');
        return redirect()->back();
    }



}
