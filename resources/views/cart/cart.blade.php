@extends('layouts.frontend.master')

@section('title','Cart')



@push('css')

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">



    <link href="{{ asset('assets/frontend/css/DetailsPost/responsive.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/cart/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
{{--    <link href="{{ asset('assets/frontend/css/cart/font-awesome.min.css')}}" rel="stylesheet">--}}

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
            <a href="{{route('post.index')}}">Books</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Cart</span>
        </div>
    </div>

    <!-- Page -->
    <div class="page-area cart-page spad">
        <div class="container">
            <div class="cart-table table table-hover col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="product-th">Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th class="total-th">Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $total_price = 0;
                    @endphp
                    @forelse($carts as $cart)
                    <tr>
                        <td class="product-col">
                            <img src="{{asset('storage/post/')}}/{{\App\Post::find($cart->post_id)->image}}" height="120px" width="150px" alt="Bag image">
                            <div class="pc-title">
                                <h4> {{\App\Post::find($cart->post_id)->title}} </h4>
                                <a href="{{route('cart.destroy',$cart->id)}}">Delete item</a>
                            </div>
                        </td>
                        <td class="price-col">{{(\App\Post::find($cart->post_id)->price)}} Taka</td>
                        <td class="quy-col">
                            <div class="quy-input">
                                @if((\App\Post::find($cart->post_id)->quantity)>($cart->quantity))

                                <span>Qty</span>
                                <form action="{{route('cart.single.update',$cart->id)}}" method="PUT">
                                <input type="number" name="quantity" value="{{$cart->quantity}}" min="1">
                                <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                @else
                                    <span>Qty</span>
                                <div class="row">
                                    <form action="{{route('cart.single.update',$cart->id)}}" method="PUT">
                                        <input type="number" name="quantity" value="{{$cart->quantity}}" min="1">
                                        <p class="btn btn-danger mt-2 ">Stock Out</p>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </td>
                        @php
                            $total_price += $cart->quantity * (\App\Post::find($cart->post_id)->price)
                        @endphp
                        <td class="total-col">{{($cart->quantity) *(\App\Post::find($cart->post_id)->price)}} Taka</td>
                    </tr>
                    @empty

                    </tbody>


                        <h3> No Books found in your cart list</h3>

                    @endforelse
                    <tr>
                        <td colspan="2"></td>
                        <td style="background-color: #8abeb7; width: 50px;" class="text-center">Total Amount</td>
                        <td>{{$total_price}} Taka</td>
                    </tr>
                </table>
            </div>
            <div class="row cart-buttons" style="margin-top: 100px;">
                <div class="col-lg-5 col-md-5 mb-4">
                    <a href="{{route('home')}}"> <div class=" btn btn-primary" > Continue shopping </div> </a>

                </div>
                <div class="col-lg-7 col-md-7 text-lg-right text-left">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{route('cart.clear')}}"> <div class=" btn btn-primary" > Clear Cart </div> </a>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{route('cart.checkout')}}"> <div class=" btn btn-primary" > Checkout  </div> </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
{{--        <div class="card-warp">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="shipping-info">--}}
{{--                            <h4>Shipping method</h4>--}}
{{--                            <p>Select the one you want</p>--}}
{{--                            <div class="shipping-chooes">--}}
{{--                                <div class="sc-item">--}}
{{--                                    <input type="radio" name="sc" id="one">--}}
{{--                                    <label for="one">Next day delivery<span>$4.99</span></label>--}}
{{--                                </div>--}}
{{--                                <div class="sc-item">--}}
{{--                                    <input type="radio" name="sc" id="two">--}}
{{--                                    <label for="two">Standard delivery<span>$1.99</span></label>--}}
{{--                                </div>--}}
{{--                                <div class="sc-item">--}}
{{--                                    <input type="radio" name="sc" id="three">--}}
{{--                                    <label for="three">Personal Pickup<span>Free</span></label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <h4>Cupon code</h4>--}}
{{--                            <p>Enter your cupone code</p>--}}
{{--                            <div class="cupon-input">--}}
{{--                                <input type="text">--}}
{{--                                <button class="site-btn">Apply</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="offset-lg-2 col-lg-6">--}}
{{--                        <div class="cart-total-details">--}}


{{--                            <h4>Cart total</h4>--}}
{{--                            <p>Final Info</p>--}}
{{--                            <ul class="cart-total-card">--}}
{{--                                <li>Subtotal<span>$59.90</span></li>--}}
{{--                                <li>Shipping<span>Free</span></li>--}}
{{--                                <li class="total">Total<span>$59.90</span></li>--}}
{{--                            </ul>--}}
{{--                                @if((\App\Post::find($cart->post_id)->quantity)>($cart->quantity))--}}
{{--                            <a class="site-btn btn-full" href="checkout.html">Proceed to checkout</a>--}}
{{--                                @else--}}
{{--                                    <div class="alert alert-danger">--}}
{{--                                        <p>Please remove the stock out product </p>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!-- Page end -->


@endsection


@push('js')

    <link href="{{ asset('assets/frontend/js/cart/mixitup.min.js')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/js/cart/sly.min.js')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/js/cart/jquery.nicescroll.min.js')}}" rel="stylesheet">



@endpush