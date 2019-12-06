<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.show',compact('order'));
    }



    public function order()
    {
        $orders = Auth::user()->orders;

        return view('admin.order.show',compact('orders'));
    }
}
