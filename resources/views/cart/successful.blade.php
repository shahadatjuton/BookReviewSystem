
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-mail Notification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div style="margin-top: 100px;">
            <h1 class="text-center"> Your order sent successfully!!</h1>
        </div>
        <div>
            <h1 class="text-center"> Your order No:  {{$order_no}}</h1>
        </div>
        <div class="form-group row mb-4">

            {{--    <a target="_blank" href="{{route('cart.invoice', $carts->id)}}"  class="btn btn-primary">--}}
            {{--        generate invoice--}}
            {{--    </a>--}}

        </div>
        <h4 class="text-center"><a href="{{route('home')}}">HOME</a></h4>
    </div>
</body>
</html>
