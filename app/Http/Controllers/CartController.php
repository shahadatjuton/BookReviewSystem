<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Sodium\increment;

class CartController extends Controller
{
    public function store(Request $request, $id)
    {
        $post= Post::findOrFail($id);
        $user_ip = $request->ip();
        $cart = Cart::where('post_id', $id)->first();

        if (Cart::where('user_ip',$user_ip)->where('post_id',$id)->exists())
        {
            Cart::where('user_ip',$user_ip)->where('post_id',$id)->increment('quantity');
            $post->quantity = $post->quantity -1 ;
            $post->save();
            Toastr::success('this book added into your cart list','success');
            return redirect()->back();
        }else
        {
            $cart = new Cart();
            $cart->post_id=$id;
            $cart->user_ip = $user_ip;
            $cart->price = 7;
            $cart->save();

            $post->quantity = $post->quantity - 1;
            $post->save();


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
        $cart = Cart::findOrFail($id);
        $cart->delete();
        Toastr::success('this book removed from your cart list','success');
        return redirect()->back();

    }

    public function clear(Request $request)
    {

        $user_ip = $request->ip();

        $carts =  Cart::where('user_ip',$user_ip);
        $carts->delete();

        Toastr::success('the cart list has been cleared','success');
        return redirect()->back();
    }




    public function SingleProductUpdate(Request $request, $id )
{
        $cart = Cart::FindOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();
    Toastr::success('Cart item updated successfully!!','success');
    return redirect()->back();
}

    public function checkout(Request $request)
    {
        $user_ip = $request->ip();
        $carts =Cart::where('user_ip',$user_ip)->get();
        return view('cart.checkout', compact('carts'));
    }



}
