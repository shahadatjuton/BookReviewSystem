
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF report generation</title>
{{--    <link rel="stylesheet" href="{{ asset('assets/frontend/css/common-css/bootstrap.css')}}">--}}

</head>
<body>

<!-- Page -->
    <div class="container">
    <div class="row">
        <div class="col-md-12">
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
    </div>
</div>
<!-- Page end -->


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h2 class="text-center">
                    Thank you for using this application!!
                </h2>
            </div>
        </div>
    </div>
</div>



</body>
</html>