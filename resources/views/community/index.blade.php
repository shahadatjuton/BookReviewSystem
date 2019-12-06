@extends('layouts.frontend.master')

@section('title','Blog')

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">


    <link href="{{ asset('assets/frontend/css/DetailsPost/styles.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/DetailsPost/responsive.css')}}" rel="stylesheet">

<style>

    ul li {
        list-style: none;
    }



</style>
@endpush

@section('content')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12 text-center">
                    <h2 class="mb-0 ">Quotes</h2>
                    <p>Keep your contribution to enrich the <strong>Quote</strong> page <br>
                    To contribute  please  <a href="{{route('quote.create')}}">click here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{route('home')}}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a class="current" href="{{route('blog.index')}}">Quote</a>

            <!-- Top Search Area -->
            <a class="float-right">
                <div>
                    <form action="{{route('quotes.search')}}" method="GET">

                        <input type="search" name="keyword" id="topSearch" value="{{ old('keyword') }}" placeholder=" Quote-Search">
                        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </a>


        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-4">
                    @foreach($quotes as $quote)
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <p>
                                    <img src="{{asset('storage/quote/'.$quote->image)}}" alt="Image" class="img-fluid">
                                </p>
                            </div>
                            <div class="col-md-8 mb-4">
                                <p>{{$quote->quote}}</p>

                                <p>
                                   <strong><b>--</b></strong> <span class="ml-4">{{$quote->author}}</span>

                                </p>

{{--                                <a href="{{route('blog.singleblog', $quote->id)}}" class="btn btn-primary rounded-0 btn-lg px-2">Read More</a>--}}
                            </div>
                            <div class="col-md-12 mb-4">
                                <p>
                                   Published By <strong>{{$quote->user->name}}</strong>   at {{$quote->created_at}}
                                </p>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="col-md-4 mb-4">
{{--       =============== second div             --}}



                    <div class="single-sidebar-widget popular-post-widget">
                        <h4 class="single-sidebar-widget__title">Popular Post</h4>
                        <div class="popular-post-list">
                            @foreach($blog as $blog)
                            <div class="single-post-list">
                                <div class="thumb">
                                    <img class="card-img rounded-0" src="{{asset('storage/blog/'.$blog->image)}}" alt="">
                                    <ul class="thumb-info">
                                        <li class="text-center"><a href="#">{{ $blog->title}}</a></li>
                                        <li class="text-center"><a href="#">Published by  <strong>{{$blog->user->name}}</strong></a></li>
                                    </ul>
                                </div>
                                <div class="details mt-20">
                                    <a href="blog-single.html">
                                        <strong>{{Str::limit($blog->description, 100)}}</strong>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')

@endpush