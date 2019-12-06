<?php

namespace App\Http\Controllers\admin;

use App\ContactMessage;
use App\Http\Controllers\Controller;
use App\Mail\ContactMessageToUser;
use App\Mail\NotifySubscriber;
use App\Notifications\NotifyPublisher;
use App\Reply;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function index()
    {
        $contact_messages = ContactMessage::orderBy('id', 'DESC')->get();
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
         $messages->read_status =1;
         $messages->save();

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
//        $contact_message->user->notify(new NotifyPublisher($reply));
        Mail::to($contact_message->email)->send(new ContactMessageToUser($reply));

        Toastr::success('Reply sent successfully','success');
        return redirect()->back();



    }









}
