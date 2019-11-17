<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\PaymentMethod;
use App\Subscriber;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $paymentmethods = PaymentMethod::latest()->get();
        return view('admin.paymentmethod.index', compact('paymentmethods'));
    }

    public function create()
    {
        return view('admin.paymentmethod.create');

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required'

        ]);

        $paymentmethod= new PaymentMethod();

        $paymentmethod->name=$request->name;
        $paymentmethod->save();

        Toastr::success('Payment Method saved successfully', 'success' );

        return redirect()->route('admin.paymentmethod.index');

    }

    public function destroy(Request $request, $id)
    {

        $paymentmethod= PaymentMethod::find($id);
        $paymentmethod->delete();
        Toastr::success('Your Data deleted successfully', 'successs');
        return redirect()->route('admin.paymentmethod.index');
    }

}
