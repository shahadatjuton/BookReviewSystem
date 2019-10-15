<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(request $request)
    {
        $this->validate($request,[
           'email'=>'required|unique:subscribers'
        ]);

        $subscribers = new Subscriber();
        $subscribers->email = $request->email;
        $subscribers->save();
        Toastr::success('Your email is successfully added in the subscriber list','success');
        return redirect()->back();
    }



}
