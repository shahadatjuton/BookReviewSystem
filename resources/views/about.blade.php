@extends('layouts.frontend.master')

@section('title','BookReview')

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">


@endpush

@section('content')




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



    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">About Us</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="#">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">About Us</span>
        </div>
    </div>

    <div class="container pt-5 mb-5">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="section-title-underline">
                    <span>Book Lover</span>
                </h2>
            </div>
            <div class="col-lg-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, iure dolorum! Nam veniam tempore tenetur aliquam architecto, hic alias quia quisquam, obcaecati laborum dolores. Ex libero cumque veritatis numquam placeat?</p>
            </div>
            <div class="col-lg-4">
                <p>Nam veniam tempore tenetur aliquam
                    architecto, hic alias quia quisquam, obcaecati laborum dolores. Ex libero cumque veritatis numquam placeat?</p>
            </div>
        </div>
    </div>


    <div class="site-section">
        <div class="container">
            @foreach($randomPost as $random)
            <div class="row mb-5">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <img src="{{asset('storage/post/'.$random->image)}}"  alt="Image" class="img-fluid">


                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-5">
                        <span>Why Book Lover</span>
                    </h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At itaque dolore libero corrupti! Itaque, delectus?</p>
                    <p>Modi sit dolor repellat esse! Sed necessitatibus itaque libero odit placeat nesciunt, voluptatum totam facere.</p>
                </div>
            </div>
            @endforeach


            <div class="row">

                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                    <img src="images/person_1.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-lg-5 mr-auto align-self-center order-2 order-lg-1">
                    <h2 class="section-title-underline mb-5">
                        <span>Personalized Learning</span>
                    </h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At itaque dolore libero corrupti! Itaque, delectus?</p>
                    <p>Modi sit dolor repellat esse! Sed necessitatibus itaque libero odit placeat nesciunt, voluptatum totam facere.</p>
                </div>

            </div>

        </div>
    </div>


    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <span class="icon flaticon-mortarboard"></span>
                    <h3>Our Philosphy</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <span class="icon flaticon-school-material"></span>
                    <h3>Academics Principle</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                        Dolore, amet reprehenderit.</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <span class="icon flaticon-library"></span>
                    <h3>Key of Success</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                        Dolore, amet reprehenderit.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-4 mb-5">
                    <h2 class="section-title-underline mb-5">
                        <span>Our Admin Panel</span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">

                    <div class="feature-1 border person text-center">
                        <img src="images/person_1.jpg" alt="Image" class="img-fluid">
                        <div class="feature-1-content">
                            <h2>Craig Daniel</h2>
                            <span class="position mb-3 d-block">Math Teacher</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
                    <div class="feature-1 border person text-center">
                        <img src="images/person_2.jpg" alt="Image" class="img-fluid">
                        <div class="feature-1-content">
                            <h2>Taylor Simpson</h2>
                            <span class="position mb-3 d-block">Math Teacher</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
                    <div class="feature-1 border person text-center">
                        <img src="images/person_3.jpg" alt="Image" class="img-fluid">
                        <div class="feature-1-content">
                            <h2>Jonas Tabble</h2>
                            <span class="position mb-3 d-block">Math Teacher</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">

                    <div class="feature-1 border person text-center">
                        <img src="images/person_4.jpg" alt="Image" class="img-fluid">
                        <div class="feature-1-content">
                            <h2>Craig Daniel</h2>
                            <span class="position mb-3 d-block">Math Teacher</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
                    <div class="feature-1 border person text-center">
                        <img src="images/person_2.jpg" alt="Image" class="img-fluid">
                        <div class="feature-1-content">
                            <h2>Taylor Simpson</h2>
                            <span class="position mb-3 d-block">Math Teacher</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
                    <div class="feature-1 border person text-center">
                        <img src="images/person_3.jpg" alt="Image" class="img-fluid">
                        <div class="feature-1-content">
                            <h2>Jonas Tabble</h2>
                            <span class="position mb-3 d-block">Math Teacher</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>









    <div class="site-section ftco-subscribe-1" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h2>Subscribe to us!</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,</p>
                </div>
                <div class="col-lg-5">
                    <form action="" class="d-flex">
                        <input type="text" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
                        <button class="btn btn-primary rounded py-3 px-4" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- .site-wrap -->

<!-- loader -->
{{--<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>--}}

@endsection


@push('js')

@endpush