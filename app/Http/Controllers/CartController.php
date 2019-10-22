<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request, $id)
    {
        $post= Post::findOrFail($id);
        $user_ip = $request->ip();
        $cart = new Cart();
        $cart->post_id = $id;

        if (Cart::where('user_ip',$user_ip)->where('post_id',$id)->exists())
        {
            Cart::where('user_ip',$user_ip)->where('post_id',$id)->increment('quantity');
            $post->quantity = $post->quantity - $cart->quantity;
            Toastr::success('this book added into your cart list','success');
            return redirect()->back();
        }else
        {
            $post->quantity = $post->quantity - $cart->quantity;
            $cart->user_ip = $user_ip;
            $cart->price = 7;
            $cart->save();
            Toastr::success('this book added into your cart list','success');
            return redirect()->back();
        }


    }


    public function index(Request $request)
    {
        $user_ip = $request->ip();
        $carts =Cart::where('user_ip',$user_ip)->get();
        return view('cart.cart',compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        Toastr::success('this book removed from your cart list','success');
        return redirect()->back();

    }

    public function clear(Request $request)
    {
        $user_ip = $request->ip();

        Cart::where('user_ip',$user_ip)->delete();

        Toastr::success('the cart list has been cleared','success');
        return redirect()->back();
    }




}
