<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Community;
use App\Quote;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $quotes = Quote::where('status',1)->orderBy('id', 'DESC')->get();
        $blog = BlogPost::all()->random(2);

        return view('community.index',compact('quotes','blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('community.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'quote'=>'required',
            'image'=>'mimes:jpeg,bmp,png,jpg',
            'author'=>'required',


        ]);

        $image = $request->file('image');
        $slug = str::slug($request->author);

        if (isset($image)) {

            $currant_date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('quote')) {

                Storage::disk('public')->makeDirectory('quote');
            }

            $imageSize=Image::make($image)->resize(1900,1266)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('quote/'.$image_name,$imageSize);

        }else {

            $image_name="default.png";
        }

        $quote =new Quote();
        $quote->user_id= Auth::id();
        $quote->author=$request->author;

        $quote->image=$image_name;
        $quote->quote=$request->quote;
        $quote->save();

        Toastr::success('Quote created successfully', 'success');
        return redirect()->route('quote.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        //
    }
}
