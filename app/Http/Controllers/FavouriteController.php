<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{



    public function add(request $request, $id)
    {
        $user = Auth::user();
        $isFavorite = $user->favourite_posts()->where('post_id',$id)->count();

        if ($isFavorite == 0)
        {
            $user->favourite_posts()->attach($id);
            Toastr::success('Post successfully added to your favorite list :)','Success');
            return redirect()->back();
        } else {
            $user->favourite_posts()->detach($id);
            Toastr::success('Post successfully removed form your favorite list :)','Success');
            return redirect()->back();
        }


    }



}
