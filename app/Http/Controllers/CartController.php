<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Order;
use App\PaymentMethod;
use App\Post;
use App\Rating;
use App\Transection;
use Barryvdh\DomPDF\Facade as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use function Sodium\increment;
use Stripe\Charge;
use Stripe\Stripe;


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
        $post = Post::findOrFail( $cart->post_id);
        $cartQuantity = $cart->quantity;
        $requestQuantity = $request->quantity;

        if ($requestQuantity > $cartQuantity)
        {
            $operationalValue = $requestQuantity - $cartQuantity;
            $cart->quantity = $request->quantity;
            $post->quantity = $post->quantity - $operationalValue ;
            $post->save();
            $cart->save();

            Toastr::success('Cart item updated successfully!!','success');
            return redirect()->back();
        }elseif ($cartQuantity > $requestQuantity)
        {
            $operationalValue = $cartQuantity - $requestQuantity;
            $cart->quantity = $request->quantity;
            $post->quantity;
            $post->quantity = $post->quantity + $operationalValue ;
            $post->save();
            $cart->save();
            Toastr::success('Cart item updated successfully!!','success');
            return redirect()->back();
        }else{
            Toastr::success('Noting to update your cart list!!','success');
            return redirect()->back();
        }



}

    public function checkout(Request $request)
    {
        $paymentmethods =PaymentMethod::all();
        $user_ip = $request->ip();
        $carts =Cart::where('user_ip',$user_ip)->get();
        return view('cart.checkout', compact('carts','paymentmethods'));
    }


    public function generateInvoice($id)
    {
        $carts = Cart::where('id',$id)->get();

        $pdf = PDF::loadView('cart.invoice', compact('carts'));
        return $pdf->stream('invoice.pdf');
    }

    public function order(Request $request)
    {

//return $request;
        $this->validate($request,[

            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $user_ip = $request->ip();
        $carts =Cart::where('user_ip',$user_ip)->get();

        $order =new Order();
        $order->user_id= Auth::id();
        $order->name=$request->name;
        $order->email=$request->email;
        $order->phone=$request->phone;
        $order->address = $request->address;
        $order->order_status = false;

        foreach ($request->paymentmethod as $value){

         $order->payment_method=$value;

        }


        $order->save();


        if ($value ==2)
        {
            $order_no= $order->id;
            return view('cart.stripe',compact('order_no'));
        }elseif ($value==3 or $value==4)
        {
            $order_no= $order->id;
            return view('cart.transection',compact('order_no'));
        }else
        {
           $order_no= $order->id;
            $user_ip = $request->ip();

            $carts =  Cart::where('user_ip',$user_ip);
            $carts->delete();
            return view('cart.successful',compact('order_no'));
        }



    }


    public function transection(Request $request)
    {


        return view('cart.transection');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stripe(Request $request)
    {
        Stripe::setApiKey('sk_test_MSg5Fdl1Pj41suNB4aFipQEb00eEskG5eV');

// Token is created using Stripe Checkout or Elements!
// Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $charge =Charge::create([
            'amount' => 999 * 100,
            'currency' => 'usd',
            'description' => 'Successfully paid',
            'source' => $token,
        ]);
        dd($charge);
        return redirect()->back();
    }


    public function transectionStore(Request $request)
    {


        foreach ($request->paymentmethod as $value){

            $payment=$value;
        }
        $transaction = new Transection();
            $transaction->user_id=Auth::user()->id;
          $transaction->payment_method=$payment;
          $transaction->trx_ID=$request->trx_id;
          $transaction->order_id =$request->order_no;
        $transaction->save();
        $user_ip = $request->ip();

        $carts =  Cart::where('user_ip',$user_ip);
        $carts->delete();
        Toastr::success('Your transection id sent!!','success');
        return redirect()->route('home');
    }
}
