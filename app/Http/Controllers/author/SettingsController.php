<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('author.settings.index',compact('user'));
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
        $this->validate($request,[

            'name'=>'required',
            'email'=>'required|email',

        ]);

        $image = $request->file('image');
        $slug = str::slug($request->name);
        $user = User::findOrFail(Auth::id());

        if (isset($image)) {

            $currant_date = Carbon::now()->toDateString();
            $image_name = $slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================

            if (!Storage::disk('public')->exists('profile')) {

                Storage::disk('public')->makeDirectory('profile');

            }

            //==========Check existing image and delete ==================

            if (Storage::disk('public')->exists('profile/'. $user->image )) {

                Storage::disk('public')->delete('profile/'. $user->image );

            }

            //==========Make new image ==================

            $imageSize=Image::make($image)->resize(500,500)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('profile/'.$image_name,$imageSize);

        }else {

            $image_name=$user->image ;
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $image_name;
        $user->save();

        Toastr::success('Profile  Updated successfully', 'success');
        return redirect()->back();
    }



    /**
     * match with old password
     * Changing Password
     */

    public function pswupdate(Request $request, $id)
    {
        $this->validate( $request,[
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword))
        {
            if (!Hash::check($request->password, $hashedPassword))
            {
                $user= User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Toastr::warning('Your password has been changed successfully!','warning');
                Auth::logout();
                return redirect()->back();

            } else
            {
                Toastr::warning('New password can not be same as old password','warning');
                return redirect()->back();


            }
        } else
        {
            Toastr::error('Your password does not match', 'error');
            return redirect()->back();


        }

    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
