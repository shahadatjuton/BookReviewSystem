@extends('layouts.frontend.master')

@section('title','Blog-Post')



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
            <a href="{{route('home')}}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a class="current" href="{{route('blog.index')}}">Blog</a>

        </div>
    </div>



    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-4">

                    <h2 class="section-title-underline mb-5 text-center">
                        <span>{{ $post->title }}</span>
                    </h2>

                    <p>
                        <img src="{{asset('storage/blog/'.$post->image)}}" alt="Image" class="img-fluid">
                    </p>

                    <p class="text-center"> Posted by <b><i>{{ $post->user->name }}</i></b> On <b>{{ $post-> created_at->diffForhumans()  }}</b></p>


                    <p class="text-center">{!! html_entity_decode($post->description) !!}</p>


                </div>
                <div class="col-lg-3 ml-auto align-self-center">
{{--  ==================Categories & Tags===================                  --}}


{{--                    <div class="categories">--}}
{{--                        <h3 class="section-title-underline mb-5">--}}
{{--                            <span>Categories</span>--}}
{{--                        </h3>--}}
{{--                        @foreach($post->categories as $category)--}}
{{--                            <ul class=" primary list-unstyled mb-5">--}}
{{--                                <li> <a href="{{route('category.posts',$category->slug)}}">{{$category->name}}</a></li>--}}
{{--                            </ul>--}}
{{--                        @endforeach--}}

{{--                        <hr>--}}
{{--                    </div>--}}

{{--                    <div class="tags">--}}
{{--                        <h3 class="section-title-underline mb-5">--}}
{{--                            <span>Used Tags</span>--}}
{{--                        </h3>--}}
{{--                        @foreach($post->tags as $tag)--}}

{{--                                <ul class=" primary list-unstyled mb-5">--}}
{{--                                    <li> <a href="{{route('category.posts',$tag->slug)}}">{{$tag->name}}</a></li>--}}

{{--                            </ul>--}}
{{--                        @endforeach--}}

{{--                        <hr>--}}
{{--                    </div>--}}


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
                            <p class="desc mb-4">{{ Str::limit($randomPost->body,50) }}</p>

                            <p><a href="{{ route('post.details', $randomPost->slug) }}" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>
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


                        <form method="post" action="{{route('blog.commentstore',$post->id)}}">
                            @csrf
                            <div class="row">


                                <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                @guest
                                <div class="col-sm-12">
                                    <button class="submit-btn " type="button" id="form-submit" onclick="toastr.info('To comment here! You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><b>POST COMMENT</b></button>
                                    <p class="text-center ml-4">Click <a href="{{route('login')}}">Here</a> to log in</a></p>
                                </div><!-- col-sm-12 -->
                                @else
                                    <div class="col-sm-12">
                                        <button class="submit-btn text-center" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                    </div><!-- col-sm-12 -->
                                @endguest

                            </div><!-- row -->
                        </form>


                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{$post->BlogComments()->count()}})</b></h4>
                    @if($post->BlogComments()->count() == 0)
                        No Comments found for this post
                    @else
                    <div class="commnets-area">
                        @foreach($post->BlogComments as $comment)

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