@extends('layouts.frontend.master')

@section('title','Blog')

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">


    <link href="{{ asset('assets/frontend/css/DetailsPost/styles.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/DetailsPost/responsive.css')}}" rel="stylesheet">


@endpush

@section('content')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12 text-center">
                    <h2 class="mb-0 ">Blog</h2>
                    <p>Keep your contribution to enrich the blog page <br>
                    To post please  <a href="{{route('blog.create')}}">click here</a>
                    </p>
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
                    @foreach($post as $post)
                    <div class="row">
                    <div class="col-md-4 mb-4">
                        <p>
                            <img src="{{asset('storage/blog/'.$post->image)}}" alt="Image" class="img-fluid">
                        </p>
                    </div>
                    <div class="col-md-8 mb-4">
                        <p>
                            {{ $post->created_at->format('d M,Y') }} <span class="ml-4">{{$post->user->name}}</span>

                        </p>
                        <p>{{$post->title}}</p>
                        <p>{{$post->body}}</p>
                        <a href="{{route('blog.singleblog', $post->slug)}}" class="btn btn-primary rounded-0 btn-lg px-2">Read More</a>
                    </div>
                    </div>
                    @endforeach


                </div>
                <div class="col-md-4 mb-4">
{{--       =============== second div             --}}
                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')

@endpush