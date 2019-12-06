@extends('layouts.frontend.master')

@section('title','BookReview')

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">


    <style>
        .favourite_posts{
            color: #0f9d58;
        }


        .text-warning {
            color: #ccc !important;
        }

        .has {
            color: #ffb700 !important;
        }

    </style>
@endpush

@section('content')



    <div class="hero-slide owl-carousel site-blocks-cover">
        @foreach($categories as $category)
        <div class="intro-section" style="background-image: url({{ URL::asset('storage/Category/slider/'.$category->image) }});">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                        <a href="{{route('category.posts',$category->slug)}}"><h1>{{$category->name}}</h1></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <div></div>


    {{--   =========================== Recently published  books    =======================     --}}

    <div class="site-section">
        <div class="container">


            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-6 mb-5">
                    <h2 class="section-title-underline mb-3">
                        <span>Recently Published Books</span>
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, id?</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="owl-slide-3 owl-carousel">

                        @foreach( $posts as $post )
                            <div class="course-1-item">
                                <figure class="thumnail">
                                    <a href="course-single.html"><img src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->title}}"  class="img-fluid"></a>
                                    <div class="price">{{$post->price}} TAKA</div>
                                    <div class="category"><h3>{{$post->title}}</h3></div>
                                </figure>
                                <div class="course-1-content pb-4">
                                    @if($post->quantity > 0)
                                    <p><a href="{{ route('cart.store', $post->id) }}" class="btn btn-success rounded-0 px-4">Add to Cart</a></p>
                                    @else
                                        <p class="btn btn-danger rounded-0 px-4 disabled">Stock Out</p>
                                    @endif

                                        @php
                                            $ratingsSum = \App\Rating::where('post_id', $post->id)->sum('rating_star');
                                            $ratingsCount = \App\Rating::where('post_id', $post->id)->count();

                                            $avgRating = 0;

                                           if ($ratingsCount > 0)
                                           {
                                            $avgRating = $ratingsSum/$ratingsCount;
                                           }
                                        @endphp
                                        @if($avgRating < 1)
                                            <div class="rating text-center mb-2 mt-5">
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                            </div>
                                        @elseif($avgRating == 1 || $avgRating < 1.5)
                                            <div class="rating text-center mb-2 mt-5">
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                            </div>
                                        @elseif($avgRating == 2 || $avgRating < 2.5)
                                            <div class="rating text-center mb-2 mt-5">
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                            </div>
                                        @elseif($avgRating == 3 || $avgRating < 3.5)
                                            <div class="rating text-center mb-2 mt-5">
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning"></span>
                                                <span class="icon-star2 text-warning"></span>
                                            </div>
                                        @elseif($avgRating == 4 || $avgRating < 4.5)
                                            <div class="rating text-center mb-2 mt-5">
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning"></span>
                                            </div>
                                        @else
                                            <div class="rating text-center mb-2 mt-5">
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                                <span class="icon-star2 text-warning has"></span>
                                            </div>
                                        @endif
                                    <p class="desc mb-4">{{Str::limit( $post->body, 30) }}</p>
                                    <p><a href="{{ route('post.details', $post->slug) }}" class="btn btn-primary rounded-0 px-4">Book Details</a></p>



                                </div>
                                <div class="post-footer">
                                    <ul >

                                        <li>
                                            @guest
                                                <a href="javascript:void(0);"
                                                   onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="fas fa-heart"></i>{{ $post->favourite_to_users->count() }}</a>
                                            @else
                                                <a href="javascript:void(0);"
                                                   onclick="document.getElementById('favourite-post-{{$post->id}}').submit();"

                                                   class="{{ Auth::user()->favourite_posts()->where('post_id',$post->id)->count()==0? 'favourite_posts':'' }}" >
                                                    <i class="fas fa-heart"></i>{{ $post->favourite_to_users->count() }}</a>

                                                <form id="favourite-post-{{$post->id}}" method="post" action="{{route('post.favourite',$post->id)}}" style="display: none;">
                                                    @csrf
                                                </form>

                                            @endguest



                                        </li>
                                        <li><a href="#"><i class="fas fa-comment"></i>6</a></li>
                                        <li><a href="#"><i class="fas fa-eye"> </i>{{ $post->view_count}}</a></li>
                                    </ul>
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

        </div>
    </div>
    <p class="text-center"><a href="{{ route('post.index', $post->slug) }}" class="btn btn-primary rounded-0 px-4">View All Posts</a></p>


    {{--   =========================== Popular books    =======================     --}}


    <div class="site-section">
        <div class="container">


            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-6 mb-5">
                    <h2 class="section-title-underline mb-3">
                        <span>Popular Books</span>
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, id?</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="owl-slide-3 owl-carousel">

                       @foreach( $popular_posts as $post )
                            <div class="course-1-item">
                                <figure class="thumnail">
                                    <a href="course-single.html"><img src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->title}}"  class="img-fluid"></a>
                                    <div class="price">99.00 Taka</div>
                                    <div class="category"><h3>{{$post->title}}</h3></div>
                                </figure>
                                <div class="course-1-content pb-4">
                                    @if($post->quantity > 0)
                                    <p><a href="{{ route('cart.store', $post->id) }}" class="btn btn-success rounded-0 px-4">Add to Cart</a></p>
                                    @else
                                        <p class="btn btn-danger rounded-0 px-4 disabled">Stock Out</p>
                                    @endif
                                        <p class="desc mb-4">{{Str::limit( $post->body, 30) }}</p>

                                        <div class="rating text-center mb-3">
                                        <span class="icon-star2 text-warning"></span>
                                        <span class="icon-star2 text-warning"></span>
                                        <span class="icon-star2 text-warning"></span>
                                        <span class="icon-star2 text-warning"></span>
                                        <span class="icon-star2 text-warning"></span>
                                    </div>
                                    <p><a href="{{ route('post.details', $post->slug) }}" class="btn btn-primary rounded-0 px-4">Book Details</a></p>



                                </div>
                                <div class="post-footer">
                                    <ul >

                                        <li>
                                            @guest
                                                <a href="javascript:void(0);"
                                                   onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="fas fa-heart"></i>{{ $post->favourite_to_users->count() }}</a>
                                            @else
                                                <a href="javascript:void(0);"
                                                   onclick="document.getElementById('favourite-post-{{$post->id}}').submit();"

                                                   class="{{ Auth::user()->favourite_posts()->where('post_id',$post->id)->count()==0? 'favourite_posts':'' }}" >
                                                    <i class="fas fa-heart"></i>{{ $post->favourite_to_users->count() }}</a>

                                                <form id="favourite-post-{{$post->id}}" method="post" action="{{route('post.favourite',$post->id)}}" style="display: none;">
                                                    @csrf
                                                </form>

                                            @endguest



                                        </li>
                                        <li><a href="#"><i class="fas fa-comment"></i>6</a></li>
                                        <li><a href="#"><i class="fas fa-eye"> </i>{{ $post->view_count}}</a></li>
                                    </ul>
                                </div>

                            </div>
                       @endforeach



                    </div>

                </div>
            </div>



        </div>

    </div>
    <p class="text-center"><a href="{{ route('post.index', $post->slug) }}" class="btn btn-primary rounded-0 px-4">View All Posts</a></p>




    <div class="section-bg style-1" style="background-image: url('images/about_1.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2 class="section-title-underline style-2">
                        <span>About Book Lover</span>
                    </h2>
                </div>
                <div class="col-lg-8">
                    <p class="lead">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem nesciunt quaerat ad reiciendis perferendis voluptate fugiat sunt fuga error totam.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus assumenda omnis tempora ullam alias amet eveniet voluptas, incidunt quasi aut officiis porro ad, expedita saepe necessitatibus rem debitis architecto dolore? Nam omnis sapiente placeat blanditiis voluptas dignissimos, itaque fugit a laudantium adipisci dolorem enim ipsum cum molestias? Quod quae molestias modi fugiat quisquam. Eligendi recusandae officiis debitis quas beatae aliquam?</p>

                </div>
            </div>
        </div>
    </div>

    <!-- // 05 - Block -->
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4">
                    <h2 class="section-title-underline">
                        <span>Blogs</span>
                    </h2>
                </div>
            </div>


            <div class="owl-slide owl-carousel">
@foreach($randomblog as $blog)
                <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="{{asset('storage/blog/'.$blog->image)}}" alt="{{$blog->name}}" class="img-fluid mr-3">
                        <div>
                            <span> <a href="{{route('blog.singleblog', $blog->slug)}}" >{{$blog->title}}</a></span>
                            <h3>{{$blog->user->name}}</h3>

                        </div>
                    </div>
                    <div>
                        <p>{{$blog->description}}</p>
                    </div>
                </div>

                @endforeach

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
                    <form action="{{route('subscriber.store')}}" method="post" class="d-flex">
                        @csrf

                        <input type="email" name="email" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
                        <button class="btn btn-primary rounded py-3 px-4" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')

@endpush