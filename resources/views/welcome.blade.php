@extends('layouts.frontend.master')

@section('title','BookReview')

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">


    <style>
        .favourite_posts{
            color: #0f9d58;
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

    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-4 mb-5">
                    <h2 class="section-title-underline mb-5">
                        <span>Why Academics Works</span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="feature-1 border">
                        <div class="icon-wrapper bg-primary">
                            <span class="flaticon-mortarboard text-white"></span>
                        </div>
                        <div class="feature-1-content">
                            <h2>Personalize Learning</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                            <p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="feature-1 border">
                        <div class="icon-wrapper bg-primary">
                            <span class="flaticon-school-material text-white"></span>
                        </div>
                        <div class="feature-1-content">
                            <h2>Trusted Courses</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                            <p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="feature-1 border">
                        <div class="icon-wrapper bg-primary">
                            <span class="flaticon-library text-white"></span>
                        </div>
                        <div class="feature-1-content">
                            <h2>Tools for Students</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                            <p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                                    <div class="price">$99.00</div>
                                    <div class="category"><h3>{{$post->title}}</h3></div>
                                </figure>
                                <div class="course-1-content pb-4">
                                    @if($post->quantity > 0)
                                    <p><a href="{{ route('cart.store', $post->id) }}" class="btn btn-danger rounded-0 px-4">Add to Cart</a></p>
                                    @else
                                        <div class="alert alert-danger">
                                            <p>Stock Out</p>
                                        </div>
                                    @endif
                                    <p class="desc mb-4">{{ $post->body }}</p>
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
                                    <div class="price">$99.00</div>
                                    <div class="category"><h3>{{$post->title}}</h3></div>
                                </figure>
                                <div class="course-1-content pb-4">
                                    @if($post->quantity > 0)
                                    <p><a href="{{ route('cart.store', $post->id) }}" class="btn btn-danger rounded-0 px-4">Add to Cart</a></p>
                                    @else
                                        <div class="alert alert-danger">
                                            <p>Stock Out</p>
                                        </div>
                                    @endif
                                    <p class="desc mb-4">{{ $post->body }}</p>
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
                        <span>About Our University</span>
                    </h2>
                </div>
                <div class="col-lg-8">
                    <p class="lead">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem nesciunt quaerat ad reiciendis perferendis voluptate fugiat sunt fuga error totam.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus assumenda omnis tempora ullam alias amet eveniet voluptas, incidunt quasi aut officiis porro ad, expedita saepe necessitatibus rem debitis architecto dolore? Nam omnis sapiente placeat blanditiis voluptas dignissimos, itaque fugit a laudantium adipisci dolorem enim ipsum cum molestias? Quod quae molestias modi fugiat quisquam. Eligendi recusandae officiis debitis quas beatae aliquam?</p>
                    <p><a href="#">Read more</a></p>
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
                        <span>Testimonials</span>
                    </h2>
                </div>
            </div>


            <div class="owl-slide owl-carousel">

                <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->name}}" class="img-fluid mr-3">
                        <div>
                            <h3>Allison Holmes</h3>
                            <span>Designer</span>
                        </div>
                    </div>
                    <div>
                        <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
                    </div>
                </div>

                <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                        <div>
                            <h3>Allison Holmes</h3>
                            <span>Designer</span>
                        </div>
                    </div>
                    <div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                    </div>
                </div>

                <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
                        <div>
                            <h3>Allison Holmes</h3>
                            <span>Designer</span>
                        </div>
                    </div>
                    <div>
                        <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
                    </div>
                </div>

                <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="images/person_3.jpg" alt="Image" class="img-fluid mr-3">
                        <div>
                            <h3>Allison Holmes</h3>
                            <span>Designer</span>
                        </div>
                    </div>
                    <div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                    </div>
                </div>

                <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                        <div>
                            <h3>Allison Holmes</h3>
                            <span>Designer</span>
                        </div>
                    </div>
                    <div>
                        <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
                    </div>
                </div>

                <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
                        <div>
                            <h3>Allison Holmes</h3>
                            <span>Designer</span>
                        </div>
                    </div>
                    <div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                    </div>
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

    <div class="news-updates">
        <div class="container">

            <div class="row">
                <div class="col-lg-9">
                    <div class="section-heading">
                        <h2 class="text-black">News &amp; Updates</h2>
                        <a href="#">Read All News</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="post-entry-big">
                                <a href="news-single.html" class="img-link"><img src="images/blog_large_1.jpg" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="#">June 6, 2019</a>
                                        <span class="mx-1">/</span>
                                        <a href="#">Admission</a>, <a href="#">Updates</a>
                                    </div>
                                    <h3 class="post-heading"><a href="news-single.html">Campus Camping and Learning Session</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="post-entry-big horizontal d-flex mb-4">
                                <a href="news-single.html" class="img-link mr-4"><img src="images/blog_1.jpg" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="#">June 6, 2019</a>
                                        <span class="mx-1">/</span>
                                        <a href="#">Admission</a>, <a href="#">Updates</a>
                                    </div>
                                    <h3 class="post-heading"><a href="news-single.html">Campus Camping and Learning Session</a></h3>
                                </div>
                            </div>

                            <div class="post-entry-big horizontal d-flex mb-4">
                                <a href="news-single.html" class="img-link mr-4"><img src="images/blog_2.jpg" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="#">June 6, 2019</a>
                                        <span class="mx-1">/</span>
                                        <a href="#">Admission</a>, <a href="#">Updates</a>
                                    </div>
                                    <h3 class="post-heading"><a href="news-single.html">Campus Camping and Learning Session</a></h3>
                                </div>
                            </div>

                            <div class="post-entry-big horizontal d-flex mb-4">
                                <a href="news-single.html" class="img-link mr-4"><img src="images/blog_1.jpg" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="#">June 6, 2019</a>
                                        <span class="mx-1">/</span>
                                        <a href="#">Admission</a>, <a href="#">Updates</a>
                                    </div>
                                    <h3 class="post-heading"><a href="news-single.html">Campus Camping and Learning Session</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="section-heading">
                        <h2 class="text-black">Campus Videos</h2>
                        <a href="#">View All Videos</a>
                    </div>
                    <a href="https://vimeo.com/45830194" class="video-1 mb-4" data-fancybox="" data-ratio="2">
              <span class="play">
                <span class="icon-play"></span>
              </span>
                        <img src="images/course_5.jpg" alt="Image" class="img-fluid">
                    </a>
                    <a href="https://vimeo.com/45830194" class="video-1 mb-4" data-fancybox="" data-ratio="2">
                <span class="play">
                  <span class="icon-play"></span>
                </span>
                        <img src="images/course_5.jpg" alt="Image" class="img-fluid">
                    </a>
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