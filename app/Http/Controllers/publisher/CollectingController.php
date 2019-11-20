<?php

namespace App\Http\Controllers\publisher;

use App\Category;
use App\Collecting;
use App\Http\Controllers\Controller;
use App\Rating;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CollectingController extends Controller
{


    public function index()
    {
        $collectings = Collecting::all();
        return view('publisher.collections.index',compact('collectings'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('publisher.collections.create',compact('categories'));
    }

    public function storeWriting(Request $request)
    {
        $this->validate($request,[

            'name'=>'required',
            'image'=>'mimes:jpeg,bmp,png,jpg',
            'categories'=>'required',
            'description'=>'required',
            'startDate'=>'required|date',
            'endDate'=>'required|date',

        ]);



        $image = $request->file('image');
        $slug = str::slug($request->name);

        if (isset($image)) {

            $currant_date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('collectings')) {

                Storage::disk('public')->makeDirectory('collectings');

            }

            $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('collectings/'.$image_name,$imageSize);

        }else {

            $image_name="default.png";
        }


        $coccecting = new  Collecting();

        $coccecting->name =$request->name;
        $coccecting->description =$request->description;
        $coccecting->startDate =$request->startDate;
        $coccecting->endDate =$request->endDate;
        $coccecting->image=$image_name;
        $coccecting->categories()->attach($request->categories);
        $coccecting->user_id= Auth::id();
        $coccecting->save();
        Toastr::success('Your event for collecting writings has been created successfully', 'success');
        return redirect()->route('publisher.collections.index');





    }

}
