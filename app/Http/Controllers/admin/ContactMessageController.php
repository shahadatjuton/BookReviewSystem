<?php

namespace App\Http\Controllers\admin;

use App\ContactMessage;
use App\Http\Controllers\Controller;
use App\Mail\ContactMessageToUser;
use App\Mail\NotifySubscriber;
use App\Reply;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function index()
    {
        $contact_messages = ContactMessage::all();
        return view('admin.contact.index',compact('contact_messages'));
    }

    public function destroy( Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        Toastr::success('The message deleted successfully','success');
        return redirect()->back();
    }


    public function reply(Request $request, $id)
    {

         $messages = ContactMessage::findOrFail($id);
         return view('admin.contact.reply',compact('messages'));
    }

    public function ReplyMessage (Request $request, $id)
    {
        $contact_message =ContactMessage::findOrFail($id);


        $this->validate($request,[
            'reply'=>'required',
        ]);

        $reply = new Reply();
        $reply->reply=$request->reply;
        $reply->contact_message_id = $id;
        $reply->save();

        Mail::to($contact_message->email)->send(new ContactMessageToUser($reply));

        Toastr::success('Reply sent successfully','success');
        return redirect()->back();



    }









}
