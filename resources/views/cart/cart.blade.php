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
            <a href="index.html">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a href="courses.html">Courses</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Courses</span>
        </div>
    </div>

    <!-- Page -->
    <div class="page-area cart-page spad">
        <div class="container">
            <div class="cart-table">
                <table>

                    <thead>
                    <tr>
                        <th class="product-th">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="total-th">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($carts as $cart)
                    <tr>
                        <td class="product-col">
                            <img src="{{asset('storage/post/')}}/{{\App\Post::find($cart->post_id)->image}}" height="120px" width="150px" alt="Bag image">
                            <div class="pc-title">
                                <h4> {{\App\Post::find($cart->post_id)->title}} </h4>
                                <a href="{{route('cart.destroy',$cart->id)}}">Delete Book</a>
                            </div>
                        </td>
                        <td class="price-col">${{$cart->price}}</td>
                        <td class="quy-col">
                            <div class="quy-input">
                                <span>Qty</span>
                                @if((\App\Post::find($cart->post_id)->quantity)>($cart->quantity))
                                <input type="number" value="{{$cart->quantity}}">
                                @else
                                    <div class="alert alert-danger">
                                        <p>Stock Out</p>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="total-col">${{($cart->quantity) *($cart->price)}}</td>
                    </tr>
                    </tbody>
                    @empty

                        <h3> No Books found in your cart list</h3>

                    @endforelse
                </table>
            </div>
            <div class="row cart-buttons">
                <div class="col-lg-5 col-md-5">
                    <a href="{{route('home')}}"><div class="site-btn btn-continue">Continue shooping</div></a>

                </div>
                <div class="col-lg-7 col-md-7 text-lg-right text-left">
                    <div class="site-btn btn-clear"> <a href="{{route('cart.clear')}}">Clear cart</a></div>
                    <div class="site-btn btn-line btn-update">Update Cart</div>
                </div>
            </div>
        </div>
        <div class="card-warp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="shipping-info">
                            <h4>Shipping method</h4>
                            <p>Select the one you want</p>
                            <div class="shipping-chooes">
                                <div class="sc-item">
                                    <input type="radio" name="sc" id="one">
                                    <label for="one">Next day delivery<span>$4.99</span></label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" name="sc" id="two">
                                    <label for="two">Standard delivery<span>$1.99</span></label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" name="sc" id="three">
                                    <label for="three">Personal Pickup<span>Free</span></label>
                                </div>
                            </div>
                            <h4>Cupon code</h4>
                            <p>Enter your cupone code</p>
                            <div class="cupon-input">
                                <input type="text">
                                <button class="site-btn">Apply</button>
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-2 col-lg-6">
                        <div class="cart-total-details">
                            <h4>Cart total</h4>
                            <p>Final Info</p>
                            <ul class="cart-total-card">
                                <li>Subtotal<span>$59.90</span></li>
                                <li>Shipping<span>Free</span></li>
                                <li class="total">Total<span>$59.90</span></li>
                            </ul>
                            <a class="site-btn btn-full" href="checkout.html">Proceed to checkout</a>
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