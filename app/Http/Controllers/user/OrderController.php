<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order()
    {
        $orders = Auth::user()->orders()->orderBy('id', 'DESC')->get();
        return view('user.order',compact('orders'));
    }
}
