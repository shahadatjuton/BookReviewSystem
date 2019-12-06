@extends('layouts.backend.master')

@section('title', 'Settings')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush



@section('content')


    <!-- Tabs With Only Icon Title -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2 style="margin-bottom: 20px;">
                        {{Auth::user()->name}}'s Profile
                    </h2>


                    <div class="profile-userpic">
                        <img src="{{asset('storage/profile/'.$user->image)}}" alt="{{$user->title}}"  height="120px" width="140px">

                    </div>


                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">

                        <li role="presentation">
                            <a href="#profile_only_icon_title" data-toggle="tab">
                                <i class="material-icons">face</i>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#home_only_icon_title" data-toggle="tab">
                                <i class="material-icons">home</i>
                            </a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade" id="profile_only_icon_title">
                            <!-- Horizontal Layout -->
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2 style="margin-bottom: 20px;">
                                                {{Auth::user()->name}}
                                            </h2>

                                        </div>
                                        <div class="body">
                                            <form class="form-horizontal" action="{{route('user.settings.update', Auth::user()->id)}}" method="post" enctype="multipart/form-data">

                                                @csrf

                                                @method('PUT')

                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="name">Name</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="name" class="form-control" name="name" value="{{Auth::user()->name}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="email_address_2">Email Address</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="email" id="email_address_2" class="form-control" name="email" value="{{Auth::user()->email}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="email_address_2">Profile Picture</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="file" id="image" class="form-control" name="image" value="{{Auth::user()->image}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row clearfix">
                                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #END# Horizontal Layout -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade in active" id="home_only_icon_title">
                            <!-- Horizontal Layout -->
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                <h2 style="margin-bottom: 20px;">
                                                    {{Auth::user()->name}}
                                                </h2>
                                            </h2>

                                        </div>
                                        <div class="body">
                                            <form class="form-horizontal" action="{{route('user.password.change', Auth::user()->id)}}" method="post" enctype="multipart/form-data">

                                                @csrf

                                                @method('PUT')

                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="name">Old Password</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Enter your current password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="name">New Password</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="password" id="password" class="form-control" name="password" placeholder="Enter your new password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="name">Confirm Password</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Re-enter your new password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row clearfix">
                                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #END# Horizontal Layout -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Tabs With Only Icon Title -->

@endsection



@push('js')

@endpush
