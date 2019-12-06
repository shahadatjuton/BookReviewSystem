<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Subscriber;
use Barryvdh\DomPDF\Facade as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber.index', compact('subscribers'));
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
    public function store(Request $request)
    {
        //
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
        $subscribers = Subscriber::find($id);
        $subscribers->delete();
        Toastr::success('Email is deleted from the subscriberlist', 'success');
        return redirect()->back();
    }





    public function weekly()
    {
        $date = \Carbon\Carbon::today()->subDays(7);

        $weekly_subscriber = Subscriber::where('created_at', '>=', $date)->get();

        return view('admin.subscriber.weekly',compact('weekly_subscriber'));
    }


    public function monthly()
    {
        $date = \Carbon\Carbon::today()->subDays(30);

        $last_months_subscriber = Subscriber::where('created_at', '>=', $date)->get();

        return view('admin.subscriber.monthly',compact('last_months_subscriber'));
    }


    public function monthlyreport()
    {
        $date = \Carbon\Carbon::today()->subDays(30);
        $last_months_subscriber = Post::where('created_at', '>=', $date)->get();

        $pdf = PDF::loadView('admin.reports.monthlySubscriber', compact('last_months_subscriber'));
        return $pdf->stream('monthly_post_list_report.pdf');
    }


    public function weeklyreport()
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        $weekly_subscriber = Post::where('created_at', '>=', $date)->get();

        $pdf = PDF::loadView('admin.reports.weeklySubscriber', compact('weekly_subscriber'));
        return $pdf->stream('weekly_post_list_report.pdf');
    }






}
