@extends('layouts.frontend.master')

@section('title')
{{$post->title}}
@endsection

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">

{{--    <link href="{{ asset('assets/frontend/css/DetailsPost/ionicons.css')}}" rel="stylesheet">--}}
{{--    <link href="{{ asset('assets/frontend/css/DetailsPost/styles.css')}}" rel="stylesheet">--}}
{{--    <link href="{{ asset('assets/frontend/css/DetailsPost/responsive.css')}}" rel="stylesheet">--}}


@endpush

@section('content')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">How To Create Mobile Apps Using Ionic</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="index.html">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a href="courses.html">Courses</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Courses</span>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-4">
                    <p>
                        <img src="{{asset('storage/post/'.$post->image)}}" alt="Image" class="img-fluid">
                    </p>



                    <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
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




                    <h2 class="section-title-underline mb-5 text-center">
                        <span>{{ $post->title }}</span>

                    </h2>

                    <p class="text-center"> Posted by <b><i>{{ $post->user->name }}</i></b></p>
                    <p class="mb-5 text-center">On <b>{{ $post-> created_at->diffForhumans()  }}</b></p>


                    <p class="text-center">{!! html_entity_decode($post->body) !!}</p>

                    <p class="text-center">
                        <a href="#" class="btn btn-primary rounded-0 btn-lg px-5">Add to Cart</a>
                    </p>




                </div>
                <div class="col-lg-4 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-5">
                        <span>{{ $post->title }}</span>
                    </h2>
                    <p> Posted by <b><i>{{ $post->user->name }}</i></b></p>
                    <p class="mb-5">On <b>{{ $post-> created_at->diffForhumans()  }}</b></p>


                </div>
            </div>
        </div>
    </div>

{{--related post--}}


    <div class="row">
        <div class="col-12">
            <div class="owl-slide-3 owl-carousel">

                @foreach( $randomPost as $randomPost )
                    <div class="course-1-item">
                        <figure class="thumnail">
                            <a href="course-single.html"><img src="{{asset('storage/post/'.$randomPost->image)}}" alt="POst Image"  class="img-fluid"></a>
                            <div class="price">$99.00</div>
                            <div class="category"><h3>{{$randomPost->image}}</h3></div>
                        </figure>
                        <div class="course-1-content pb-4">
                            <h2>{{$randomPost->title}}</h2>
                            <p class="desc mb-4">{{ $randomPost->body }}</p>
                            <div class="rating text-center mb-3">
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                            </div>
                            <p><a href="{{ route('post.details', $randomPost->slug) }}" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>



                        </div>
                        <div class="post-footer">
                            <ul >

                                <li>
                                    @guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><i class="fas fa-heart"></i>{{ $randomPost->favourite_to_users->count() }}</a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favourite-post-{{$randomPost->id}}').submit();"

                                           class="{{ Auth::user()->favourite_posts()->where('post_id',$post->id)->count()==0? 'favourite_posts':'' }}" >
                                            <i class="fas fa-heart"></i>{{ $randomPost->favourite_to_users->count() }}</a>

                                        <form id="favourite-post-{{$randomPost->id}}" method="post" action="{{route('post.favourite',$randomPost->id)}}" style="display: none;">
                                            @csrf
                                        </form>

                                    @endguest



                                </li>
                                <li><a href="#"><i class="fas fa-comment"></i>6</a></li>
                                <li><a href="#"><i class="fas fa-eye"> </i>{{ $randomPost->view_count}}</a></li>
                            </ul>
                        </div>

                    </div>
                @endforeach



            </div>

        </div>
    </div>

@endsection


@push('js')

@endpush