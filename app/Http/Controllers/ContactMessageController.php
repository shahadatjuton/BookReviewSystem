<?php

namespace App\Http\Controllers;

use App\ContactMessage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    public function ContactForm()
    {
        return view('contact.contact_form');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'message'=> 'required',

        ]);


        $contact_info = new ContactMessage();

        $contact_info->first_name = $request->fname;
        $contact_info->last_name = $request->lname;
        $contact_info->email = $request->email;
        $contact_info->phone = $request->phone;
        $contact_info->message = $request->message;
        $contact_info->user_id=Auth::user()->id;
        $contact_info->save();
        Toastr::success('Your message sent successfully','success');
        return redirect()->back();




    }

















}
