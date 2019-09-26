<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/frontend/fonts/icomoon/style.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css')}} ">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.css')}} ">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.theme.default.min.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.fancybox.min.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap-datepicker.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/frontend/fonts/flaticon/font/flaticon.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/frontend/css/aos.css')}}">
        <link href="{{ asset('assets/frontend/css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">

    </head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

      <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
          <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
              <span class="icon-close2 js-menu-toggle"></span>
            </div>
          </div>
          <div class="site-mobile-menu-body"></div>
        </div>


        <div class="py-2 bg-light">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-9 d-none d-lg-block">
                <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a>
                <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a>
                <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a>
              </div>
              <div class="col-lg-3 text-right">
                <a href="login.html" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
                <a href="register.html" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
              </div>
            </div>
          </div>
        </div>

        @include('layouts.frontend.partial.header')



        @yield('content')

      @include('layouts.frontend.partial.footer')




      </div>
      <!-- .site-wrap -->


      <!-- loader -->
      <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

      <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery-migrate-3.0.1.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery-ui.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/popper.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/bootstrap.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.stellar.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.countdown.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/bootstrap-datepicker.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.easing.1.3.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/aos.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.fancybox.min.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.sticky.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.mb.YTPlayer.min.js')}}"></script>





      <script src="{{ asset('assets/frontend/js/main.js')}}"></script>

    </body>
</html>
