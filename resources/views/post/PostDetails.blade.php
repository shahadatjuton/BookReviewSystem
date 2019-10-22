@extends('layouts.frontend.master')

@section('title')
{{$post->title}}
@endsection

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">


    <link href="{{ asset('assets/frontend/css/DetailsPost/styles.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/DetailsPost/responsive.css')}}" rel="stylesheet">


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



                    <div class="rating text-center mb-2 mt-5">
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
                        <p class="text-center">
                            @if($post->quantity > 0)
                            <a href="{{ route('cart.store', $post->id) }}" class="btn btn-primary rounded-0 btn-lg px-5">Add to Cart</a>
                        <p> {{$post->quantity}} items in stock</p>
                            @else
                            <div class="alert alert-danger">
                                No books available for sell
                            </div>
                            @endif
                        </p>

                    </div>




                    <h2 class="section-title-underline mb-5 text-center">
                        <span>{{ $post->title }}</span>

                    </h2>

                    <p class="text-center"> Posted by <b><i>{{ $post->user->name }}</i></b></p>
                    <p class="mb-5 text-center">On <b>{{ $post-> created_at->diffForhumans()  }}</b></p>


                    <p class="text-center">{!! html_entity_decode($post->body) !!}</p>





                </div>
                <div class="col-lg-3 ml-auto align-self-center">
                    <div class="categories">
                        <h3 class="section-title-underline mb-5">
                            <span>Used Categories</span>
                        </h3>
                        @foreach($post->categories as $category)
                            <ul class="ul-check primary list-unstyled mb-5">
                                <li> <a href="{{route('category.posts',$category->slug)}}">{{$category->name}}</a></li>
                            </ul>
                        @endforeach

                        <hr>
                    </div>

                    <div class="tags">
                        <h3 class="section-title-underline mb-5">
                            <span>Used Tags</span>
                        </h3>
                        @foreach($post->tags as $tag)

                                <ul class="ul-check primary list-unstyled mb-5">
                                    <li> <a href="{{route('category.posts',$tag->slug)}}">{{$tag->name}}</a></li>

                            </ul>
                        @endforeach

                        <hr>
                    </div>


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



{{-- ===================================Comment Section =================================================================--}}

    <section class="comment-section" >
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">

                        @guest

                            To comment you need to <a href="{{route('login')}}">Log In</a>  first. <a href="{{route('login')}}">Click Here</a>

                            @else


                        <form method="post" action="{{route('comment.store',$post->id)}}">
                            @csrf
                            <div class="row">


                                <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>

                        @endguest

                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{$post->comments()->count()}})</b></h4>
                    @if($post->comments()->count() == 0)
                        No Comments found for this post
                    @else
                    <div class="commnets-area">
                        @foreach($post->comments as $comment)

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                    <h6 class="date">on {{$comment->created_at->diffForHumans()}}</h6>
                                </div>

                                <div class="right-area">
                                    <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                </div>

                            </div><!-- post-info -->

                            <p>{{$comment->comment}}</p>

                        </div>

                        @endforeach

                    </div><!-- commnets-area -->

                    @endif



{{--                    <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>--}}

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>





@endsection


@push('js')

@endpush