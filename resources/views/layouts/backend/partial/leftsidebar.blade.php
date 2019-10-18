<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('storage/profile/'.Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>{{ __('Sign Out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>



                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <!-- ===================Start Admin Side bar ============================  -->
            @if(Request::is('admin*'))

                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.tag.index')}}">Index</a>
                        </li>
                        <li>
                            <a href="{{route('admin.tag.create')}}">Create</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">apps</i>
                        <span>Category</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.category.index')}}">Index</a>
                        </li>
                        <li>
                            <a href="{{route('admin.category.create')}}">Create</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_books</i>
                        <span>Book-Post</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.post.index')}}">Index</a>
                        </li>
                        <li>
                            <a href="{{route('admin.post.create')}}">Create</a>
                        </li>
                        <li>
                            <a href="{{route('admin.post.pending')}}">Pending-Post</a>
                        </li>
                        <li>
                            <a href="{{route('admin.post.favourite')}}">
                                <i class="material-icons">favorite</i>
                                <span>Favourite-Post</span>
                            </a>

                        </li>
                        <li>
                            <a href="{{route('admin.comment.index')}}">
                                <i class="material-icons">comment</i>
                                <span>Comments</span>
                            </a>

                        </li>
                    </ul>
                </li>


                <li class="{{ Request::is('admin/user*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment_ind</i>
                        <span>User-List</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.user.index')}}">Index</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                    <a href="{{route('admin.subscriber.index')}}">
                        <i class="material-icons">subscriptions</i>
                        <span>Subscriber List</span>
                    </a>
                </li>


                <li class="header ">System</li>

                <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                    <a href="{{route('admin.settings.index')}}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            @endif

        <!-- ================End Admin Side bar ============================  -->

            <!-- ===================Start author Side bar ============================  -->

            @if(Request::is('author*'))

                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{route('author.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_books</i>
                        <span>Book-Post</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('author.post.index')}}">Index</a>
                        </li>
                        <li>
                            <a href="{{route('author.post.create')}}">Create</a>
                        </li>

                    </ul>
                </li>


                <li class="header ">System</li>

                <li class="{{ Request::is('author/settings*') ? 'active' : '' }}">
                    <a href="{{route('author.settings.index')}}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

        @endif

        <!-- ================End author Side bar ============================  -->


    <!-- ===================Start Publisher Side bar ============================  -->

            @if(Request::is('publisher*'))

                <li class="{{ Request::is('publisher/dashboard') ? 'active' : '' }}">
                    <a href="{{route('publisher.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ Request::is('publisher/post*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_books</i>
                        <span>Book-Post</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('publisher.post.index')}}">Index</a>
                        </li>
                        <li>
                            <a href="{{route('publisher.post.create')}}">Create</a>
                        </li>
                        <li>
                            <a href="{{route('publisher.post.favourite')}}">
                                <i class="material-icons">favorite</i>
                                <span>Favourite-Post</span>
                            </a>

                        </li>
                        <li>
                            <a href="{{route('publisher.comment.index')}}">
                                <i class="material-icons">comment</i>
                                <span>Comments</span>
                            </a>

                        </li>
                    </ul>
                </li>

                <li class="header ">System</li>

                            <li class="{{ Request::is('publisher/settings') ? 'active' : '' }}">
                                <a href="{{route('publisher.settings.index')}}">
                                    <i class="material-icons">settings</i>
                                    <span>Settings</span>
                                </a>
                            </li>


                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
        @endif

        <!-- ================End Publisher Side bar ============================  -->

            <li class="header ">System</li>


            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">perm_media</i>
                    <span>Medias</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/medias/image-gallery.html">Image Gallery</a>
                    </li>
                    <li>
                        <a href="pages/medias/carousel.html">Carousel</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">pie_chart</i>
                    <span>Charts</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/charts/morris.html">Morris</a>
                    </li>
                    <li>
                        <a href="pages/charts/flot.html">Flot</a>
                    </li>
                    <li>
                        <a href="pages/charts/chartjs.html">ChartJS</a>
                    </li>
                    <li>
                        <a href="pages/charts/sparkline.html">Sparkline</a>
                    </li>
                    <li>
                        <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                    </li>
                </ul>
            </li>



            <li class="header">LABELS</li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Important</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2019-2020 <a href="javascript:void(0);">Shahadat Hossain</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>
