<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\NotifySubscriber;
use App\Notifications\PublisherNotification;
use App\Post;
use App\Quote;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::orderBy('id', 'DESC')->get();
        return view('admin.quote.index',compact('quotes'));
    }


    public function show($id)
    {
        $quote=Quote::findOrFail($id);
        return view('admin.quote.show',compact('quote'));
    }

    /**
     *  Show pending post
     */
    public function pending()
    {
        $pending_quotes = Quote::where('status',0)->latest()->get();
        return view('admin.quote.pending',compact('pending_quotes'));
    }


    /**
     *  approve the  pending post
     */
    public function approve($id)
    {
        $pending_quote=Quote::find($id);

        if($pending_quote->status == 0)
        {
            $pending_quote->status=1;

            $pending_quote->save();
            toastr::success('Your quote is approved successfully','success');
        }else{
            Toastr::Info('Your quote is already approved','info');

        }
        return redirect()->back();
    }


}
