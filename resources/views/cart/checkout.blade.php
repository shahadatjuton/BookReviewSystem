@extends('layouts.frontend.master')

@section('title','Cart')



@push('css')

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">



    <link href="{{ asset('assets/frontend/css/DetailsPost/responsive.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/cart/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/cart/font-awesome.min.css')}}" rel="stylesheet">

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
    <div class="page-area cart-page spad">
        <div class="container">
            <form class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="checkout-title">Billing Address</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" placeholder="First Name *">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" placeholder="Last Name *">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-group" placeholder="Company">
                                <select class="form-group">
                                    <option>Country *</option>
                                    <option>USA</option>
                                    <option>UK</option>
                                    <option>BANGLADESH</option>
                                </select>
                                <input type="text" class="form-group" placeholder="Address *">
                                <input type="text" class="form-group">
                                <input type="text" class="form-group" placeholder="Zipcode *">
                                <select>
                                    <option>City/Town *</option>
                                </select>
                                <select>
                                    <option>Province *</option>
                                </select>
                                <input type="text" placeholder="Phone no *">
                                <input type="email" placeholder="Email Address *">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="order-card">
                            <div class="order-details">
                                <div class="od-warp mb-4 mt-4">
                                    <h4 class="checkout-title">Your order</h4>
                                    <table class="order-table">
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
                                        @foreach($carts as $cart)
                                        <tr>
                                            <td>{{\App\Post::find($cart->post_id)->title}}</td>
                                            @php
                                                $total_price += $cart->quantity * $cart->price
                                            @endphp
                                            <td>{{($cart->quantity) *($cart->price)}} Taka</td>
                                        </tr>
                                        @endforeach
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
                                    <div class="pm-item">
                                        <input type="radio" name="pm" id="one">
                                        <label for="one">Paypal</label>
                                    </div>
                                    <div class="pm-item">
                                        <input type="radio" name="pm" id="two">
                                        <label for="two">Cash on delievery</label>
                                    </div>
                                    <div class="pm-item">
                                        <input type="radio" name="pm" id="three">
                                        <label for="three">Credit card</label>
                                    </div>
                                    <div class="pm-item">
                                        <input type="radio" name="pm" id="four" checked>
                                        <label for="four">Direct bank transfer</label>
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

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Page end -->


@endsection


@push('js')

    <link href="{{ asset('assets/frontend/js/cart/mixitup.min.js')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/js/cart/sly.min.js')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/js/cart/jquery.nicescroll.min.js')}}" rel="stylesheet">



@endpush