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
                    <h2 class="mb-0 ">Quote</h2>
                    <p>Keep your contribution to enrich the blog page <br>
                    To post please  <a href="#">click here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{route('home')}}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a class="current" href="">User-Request</a>


        </div>
    </div>

{{--  =================Create Blog Post================================ --}}

    <h1 class="text-center"> Create A Quote </h1>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 ">
                <div class="blog-post">
                    <form action="{{route('request.publisher.store',Auth::id())}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('paymentmethods') ? 'focused error' : '' }}">
                                <label for="">Be A Publisher</label>
                                <select name="paymentmethod[]" >
                                        <option value="">Publisher</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Why do you want to be a publisher?</label>
                            <textarea class="form-control" placeholder="" name="description"></textarea>
                        </div>

                        @guest
                            <div class="form-group">
                                <button type="button" class="btn btn-primary"  onclick="toastr.info('To Post here! You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })">Submit</button>
                            </div>

                         @else
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        @endguest

                    </form>
                </div>
            </div>
        </div>
    </div>











@endsection


@push('js')

@endpush