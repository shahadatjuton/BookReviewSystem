@extends('layouts.frontend.master')

@section('title','Cart')



@push('css')

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">



    <link href="{{ asset('assets/frontend/css/DetailsPost/responsive.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/cart/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">


    <link href="{{ asset('assets/frontend/css/cart/styles.css')}}" rel="stylesheet">


@endpush

@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">How To Create Mobile Apps Using Ionic</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{route('home')}}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a href="{{route('cart.index')}}">Cart</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Checkout</span>
        </div>
    </div>

    <!-- Page -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="check-out-form mt-4">

                        <h4 class="checkout-title text-center">Billing Address</h4>
                        <form action="{{route('order.cart')}}" method="post" >
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line col-md-8 mt-4">
                                    <label class="form-label" for="">Enter Reciever's Name</label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="{{old('name')}}">
                                </div>
                                <div class="form-line col-md-8 mt-4">
                                    <label class="form-label" for="">Enter Reciever's E-mail</label>
                                    <input type="text" id="email" class="form-control" name="email" placeholder="{{old('email')}}">
                                </div>
                                <div class="form-line col-md-8 mt-4">
                                    <label class="form-label" for="">Enter Reciever's Phone-Number</label>
                                    <input type="text" id="phone" class="form-control" name="phone" placeholder="{{old('phone')}}">
                                </div>

                                <div class="form-line col-md-8 mt-4">
                                    <label class="form-label" for="">Enter Reciever's Address</label>
                                    <textarea id="address" class="form-control" name="address" placeholder="{{old('address')}}"> </textarea>
                                </div>

                            </div>


                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order-card">
                        <div class="order-details">
                            <div class="od-warp mb-4 mt-4">
                                <h4 class="text-center checkout-title">Your order</h4>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_price = 0;
                                    @endphp
                                    @forelse($carts as $cart)

                                        <tr>
                                            <td>{{\App\Post::find($cart->post_id)->title}}</td>
                                            @php
                                                $total_price += $cart->quantity * $cart->price
                                            @endphp
                                            <td>{{($cart->quantity) *($cart->price)}} Taka</td>
                                        </tr>
                                    @empty
                                        <h3 class="text-center"> There is nothing to show</h3>
                                    @endforelse
                                    <tr>
                                        <td>Shipping Cost</td>
                                        <td>0 Taka</td>
                                    </tr>

                                    </tbody>
                                    <tfoot class="mt-4" style="margin-top: 50px">
                                    <tr class="order-total" style="margin-top: 50px">
                                        <th>Total</th>
                                        <th>{{$total_price}} TAKA</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method mb-4 mt-4 ">

                                <div class="form-group form-float">
                                    <div class="form-line {{ $errors->has('paymentmethods') ? 'focused error' : '' }}">
                                        <label for="">Select Payment Method</label>
                                        <select name="paymentmethod[]" >
                                            @foreach($paymentmethods as $paymentmethod)
                                                <option value="{{$paymentmethod->id}}">{{ $paymentmethod->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row mb-4">
                                    <button type="submit" class="btn btn-primary mr-4">
                                        {{ __('Place Order') }}
                                    </button>

                            <a target="_blank" href="{{route('cart.invoice', $cart->id)}}"  class="btn btn-primary">
                                generate invoice
                            </a>

                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <!-- Page end -->


@endsection


@push('js')

    <link href="{{ asset('assets/frontend/js/cart/mixitup.min.js')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/js/cart/sly.min.js')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/js/cart/jquery.nicescroll.min.js')}}" rel="stylesheet">



@endpush