@extends('layouts.frontend.master')

@section('title')
Book Review System-{{$category->slug}}
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

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url({{asset('storage/Category/'.$category->image)}})">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12 text-center">
                    <h2 class="mb-0">{{$category->slug}}</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>


{{--=================Category wise posts ===================--}}


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="index.html">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Courses</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">



                @forelse( $category->posts as $post )
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="course-1-item">
                            <figure class="thumnail">
                                <a href="course-single.html"><img src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->title}}"  class="img-fluid"></a>
                                <div class="price">$99.00</div>
                                <div class="category"><h3>{{$post->title}}</h3></div>
                            </figure>
                            <div class="course-1-content pb-4">
                                <p><a href="{{ route('post.details', $post->slug) }}" class="btn btn-danger rounded-0 px-4">Add to Cart</a></p>

                                <p class="desc mb-4">{{Str::limit( $post->body,30) }}</p>
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
                    </div>
                    @empty

                    <div>
                        <h3 class="text-center">
                            No posts available for this <span>category</span>
                        </h3>
                    </div>

                @endforelse



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






@endsection

@push('js')

@endpush