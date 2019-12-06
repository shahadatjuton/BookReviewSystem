@extends('layouts.frontend.master')

@section('title')
Book Review System-{{$tag->slug}}
@endsection

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

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">{{$tag->slug}}</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>


{{--=================Tag wise posts ===================--}}


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{route('home')}}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a href="{{route('post.index')}}">Books</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Tags</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">

                @foreach( $tag->posts as $post )
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-1-item">
                        <figure class="thumnail">
                            <a href="course-single.html"><img src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->title}}"  class="img-fluid"></a>
                            <div class="price">$99.00</div>
                            <div class="category"><h3>{{$post->title}}</h3></div>
                        </figure>
                        <div class="course-1-content pb-4">
                            <p><a href="{{ route('post.details', $post->slug) }}" class="btn btn-danger rounded-0 px-4">Add to Cart</a></p>
                            {{-- ==============================Start-Ratings======================================================--}}

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
                            {{-- ==============================End-Ratings======================================================--}}

                            <p class="desc mb-4">{{Str::limit( $post->body,30) }}</p>
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
                </div>
                @endforeach


            </div>
        </div>
    </div>


@endsection

@push('js')

@endpush