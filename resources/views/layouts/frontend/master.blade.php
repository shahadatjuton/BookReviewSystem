<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') </title>
        <!-- Font -->

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/frontend/css/common-css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/common-css/swiper.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css')}}">
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

        <!-- Toaster css -->

        <link  href="{{ asset('assets/backend/css/toastr.min.css')}}" rel="stylesheet" />
        @stack('css')
    </head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

      <div class="site-wrap">

          @include('layouts.frontend.partial.header')



          @include('layouts.frontend.partial.navbar')



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
      <script src="{{ asset('assets/frontend/js/common-js/scripts.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/common-js/swiper.js')}}"></script>
      <script src="{{ asset('assets/frontend/js/common-js/tether.min.js')}}"></script>


      <script src="{{ asset('assets/frontend/js/main.js')}}"></script>

      <script src="{{ asset('assets/backend/js/toastr.min.js')}}"></script>
      {!! Toastr::message() !!}
      <script>
          @if($errors->any())
          @foreach($errors->all() as $error)
          toastr.error('{{ $error }}','Error',{
              closeButton:true,
              progressBar:true,
          });
          @endforeach
          @endif
      </script>
      @stack('js')
    </body>
</html>
