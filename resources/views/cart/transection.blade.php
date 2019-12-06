@extends('layouts.frontend.master')

@section('title','Transection Id')

@push('css')

@endpush

@section('content')



    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('assets/frontend/images/bg_1.jpg')" >
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Transection Id</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{route('home')}}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Transection Id</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-md-7">


                    <form method="POST" action="{{ route('transection.store') }}">
                        @csrf


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="payment-method mb-4 mt-4 ">

                            <div class="form-group row">
                                <div class="form-line {{ $errors->has('paymentmethods') ? 'focused error' : '' }}">
                                    <label for="">Select Payment Method</label>
                                    <select name="paymentmethod[]" >

                                            <option value="3">Bank Transfer</option>
                                            <option value="4">Mobile Banking</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Transection Id') }}</label>

                            <div class="col-md-6">
                                <input id="trx_id" type="text" class="form-control @error('trx_id') is-invalid @enderror" name="trx_id" value="{{ old('trx_id') }}" required autocomplete="trx_id" autofocus>

                                @error('trx_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="custId" name="order_no" value="{{$order_no}}">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>



        </div>
    </div>




@endsection
