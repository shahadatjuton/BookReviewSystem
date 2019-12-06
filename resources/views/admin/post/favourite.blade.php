@extends('layouts.backend.master')

@section('title', 'Post')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush



@section('content')

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TOTAL FAVOURITE POSTS
                            <span class="badge bg-blue">{{ $posts->count() }}</span>
                            <div class="pull-right "><a href="{{route('admin.report.favourite.post')}}" class="btn btn-success"> Generate Favourite Post Report </a></div>

                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">visibility </i></th>
                                    <th><i class="material-icons">favorite </i></th>

                                    <th>Action</th>

                                </tr>
                                </thead>

                                @forelse($posts as $key=> $post)

                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{Str::limit($post->title,15)}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->view_count}}</td>
                                        <td>{{$post->favourite_to_users->count()}}</td>

                                        <td>

                                            <a class="btn btn-info waves-effect" href="{{route('admin.post.show', $post->id)}}">
                                                <i class="material-icons">visibility </i>
                                            </a>

                                            <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="removepost({{$post->id}})">
                                                <i class="material-icons" >delete</i>

                                            </button>
                                            <form  id="remove-post-{{$post->id}}" action="{{route('post.favourite', $post->id)}}"
                                                   method="post" style="display:none;"
                                            >
                                                @csrf



                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                    <h2>No favourite post found</h2>

                                    @endforelse
                                    </thead>




                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection






@push('js')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>


    <!-- Custom Js -->

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.all.min.js')}}"></script>


    <script type="text/javascript">

        function removepost(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('remove-post-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })

        }

    </script>

@endpush
