<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="d-flex align-items-center">
            <div class="site-logo">
                <a href="{{route('home')}}" class="d-block">
                    <img src="images/logo.jpg" alt="Book Review" class="img-fluid">
                </a>
            </div>
            <div class="mr-auto">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li class="">
                            <a href="{{route('home')}}" class="nav-link text-left">Home</a>
                        </li>
                        <li class="has-children">
                            <a href="about.html" class="nav-link text-left">About Us</a>
                            <ul class="dropdown">
                                <li><a href="teachers.html">Our Teachers</a></li>
                                <li><a href="about.html">Our School</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('blog.index')}}" class="nav-link text-left">Blog</a>
                        </li>
                        <li>
                            <a href="{{route('post.index')}}" class="nav-link text-left">Books</a>
                        </li>
                        <li>
                            <a href="{{route('contact.form')}}" class="nav-link text-left">Contact</a>
                        </li>
                    </ul>                                                                                                                                                                                                                                                                                          </ul>
                </nav>

            </div>
            <div class="ml-auto">


                <!-- Top Search Area -->
                <div class="top-search-area">
                    <form action="{{route('search')}}" method="GET">

                        <input type="search" name="keyword" id="topSearch" value="{{ old('keyword') }}" placeholder="Search">
                        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>




{{--                <div class="social-wrap">--}}
{{--                    <a href="#"><span class="icon-facebook"></span></a>--}}
{{--                    <a href="#"><span class="icon-twitter"></span></a>--}}
{{--                    <a href="#"><span class="icon-linkedin"></span></a>--}}

{{--                    <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span--}}
{{--                                class="icon-menu h3"></span></a>--}}
{{--                </div>--}}
            </div>

        </div>
    </div>

</header>
