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
        <a href="{{route('contact.form')}}" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a>
        <a href="{{route('contact.form')}}" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a>
        <a href="{{route('contact.form')}}" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a>
      </div>
      <div class="col-lg-3 text-right">

        @guest
 <a href="{{route('login')}}" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
 <a href="{{route('register')}}" class="small btn btn-primary px-2 py-2 rounded-0"><span class="icon-users"></span> Register</a>
 <a href="{{ route('cart.index')}}" class="small mr-3"><i class="fa fa-shopping-cart"></i>({{\App\Cart::where('user_ip', \Request::ip())->count()}})</a>

        @else
              @if(Auth::user()->role->id ==1)
            <a href="{{route('admin.dashboard')}}" class="small mr-3"><span class="bg-green"></span>Dashboard</a>

                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                  <a href="{{ route('cart.index')}}" class="small mr-3"><i class="fa fa-shopping-cart"></i>{{\App\Cart::where('user_ip', \Request::ip())->count()}}</a>

              @endif
                @if(Auth::user()->role->id ==2)
                  <a href="{{route('publisher.dashboard')}}" class="small mr-3"><span class="bg-green"></span>Dashboard</a>
                  <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>

                      <a href="{{ route('cart.index')}}" class="small mr-3"><i class="fa fa-shopping-cart"></i>{{\App\Cart::where('user_ip', \Request::ip())->count()}}</a>

                  @endif
                  @if(Auth::user()->role->id ==3)
                      <a href="{{route('author.dashboard')}}" class="small mr-3"><span class="bg-green"></span>Dashboard</a>
                      <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>

                      <a href="{{ route('cart.index')}}" class="small mr-3"><i class="fa fa-shopping-cart"></i>{{\App\Cart::where('user_ip', \Request::ip())->count()}}</a>

                  @endif
                  @if(Auth::user()->role->id ==4)
                      <a href="{{route('user.dashboard')}}" class="small mr-3"><span class="bg-green"></span>Dashboard</a>
                      <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>

                      <a href="{{ route('cart.index')}}" class="small mr-3"><i class="fa fa-shopping-cart"></i>{{\App\Cart::where('user_ip', \Request::ip())->count()}}</a>

                  @endif

        @endguest



      </div>
    </div>
  </div>
</div>