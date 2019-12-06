@extends('layouts.backend.master')

@section('title', 'Admin Dashboard')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                         <div class="text"> <a href="{{route('admin.report.user')}}"> TOTAL BOOKS </a> </div>
                        <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="1500" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL VIEWED  </div>
                        <div class="number count-to" data-from="0" data-to="{{$total_view_posts}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL COMMENTS</div>
                        <div class="number count-to" data-from="0" data-to="{{$total_comments}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL USERS</div>
                        <div class="number count-to" data-from="0" data-to="{{$total_users}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text"> <a href="{{route('admin.report.user')}}"> TODAY REGISTERED USER </a> </div>
                        <div class="number count-to" data-from="0" data-to="{{$new_users}}" data-speed="1500" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">LAST MONTH REGISTERED USER </div>
                        <div class="number count-to" data-from="0" data-to="{{$last_months_users}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">create_new_folder</i>
                    </div>
                    <div class="content">
                        <div class="text">LAST MONTH POST</div>
                        <div class="number count-to" data-from="0" data-to="{{$last_months_posts}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">add_shopping_cart</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL ORDERS</div>
                        <div class="number count-to" data-from="0" data-to="{{$total_orders}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text"> <a href="{{route('admin.report.user')}}"> TOTAL CATEGORIES </a> </div>
                        <div class="number count-to" data-from="0" data-to="{{$total_categories}}" data-speed="1500" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">import_export</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL TAGS  </div>
                        <div class="number count-to" data-from="0" data-to="{{$total_tags}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL QUOTES</div>
                        <div class="number count-to" data-from="0" data-to="{{$total_quotes}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">group_work</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL REVIEWS</div>
                        <div class="number count-to" data-from="0" data-to="{{$total_reviews}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <div class="row clearfix">
            <!-- Task Info -->
{{--            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="header">--}}
{{--                        <h2>TASK REPORTS</h2>--}}
{{--                    </div>--}}
{{--                    <div class="body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-hover dashboard-task-infos">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>NO</th>--}}
{{--                                    <th>Task</th>--}}
{{--                                    <th>Status</th>--}}
{{--                                    <th>Manager</th>--}}
{{--                                    <th>Progress</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>Total Books</td>--}}
{{--                                    <td><span class="label bg-green">Doing</span></td>--}}
{{--                                    <td>John Doe</td>--}}
{{--                                    <td>--}}
{{--                                        <div class="progress">--}}
{{--                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>2</td>--}}
{{--                                    <td>Task B</td>--}}
{{--                                    <td><span class="label bg-blue">To Do</span></td>--}}
{{--                                    <td>John Doe</td>--}}
{{--                                    <td>--}}
{{--                                        <div class="progress">--}}
{{--                                            <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>3</td>--}}
{{--                                    <td>Task C</td>--}}
{{--                                    <td><span class="label bg-light-blue">On Hold</span></td>--}}
{{--                                    <td>John Doe</td>--}}
{{--                                    <td>--}}
{{--                                        <div class="progress">--}}
{{--                                            <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>4</td>--}}
{{--                                    <td>Task D</td>--}}
{{--                                    <td><span class="label bg-orange">Wait Approvel</span></td>--}}
{{--                                    <td>John Doe</td>--}}
{{--                                    <td>--}}
{{--                                        <div class="progress">--}}
{{--                                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>5</td>--}}
{{--                                    <td>Task E</td>--}}
{{--                                    <td>--}}
{{--                                        <span class="label bg-red">Suspended</span>--}}
{{--                                    </td>--}}
{{--                                    <td>John Doe</td>--}}
{{--                                    <td>--}}
{{--                                        <div class="progress">--}}
{{--                                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- #END# Task Info -->

        </div>
    </div>
@endsection


@push('js')



@endpush
