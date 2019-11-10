@extends('layouts.backend.master')

@section('title', 'Tag')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush


@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Taggs Table

            </h2>


        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <b>TOTAL USERS </b>
                            <span class="badge bg-blue" style="font-size: 35px;">{{ $users->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Created At </th>
                                    <th>Updated At</th>
                                    <th>Action</th>

                                </tr>
                                </thead>



                                @foreach($users as $key=> $user)


                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{$user->name}}</td>
                                        @if($user->role_id == 1)
                                        <td>Admin</td>
                                        @elseif ($user->role_id ==2)
                                            <td>Publisher</td>
                                        @elseif($user->role_id ==3)
                                            <td>Author</td>
                                        @elseif($user->role_id ==4)
                                            <td>Reader</td>
                                        @endif
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->updated_at}}</td>
                                        <td>

                                            <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deleteuser({{$user->id}})">
                                                <i class="material-icons" >delete</i>

                                            </button>
                                            <form  id="delete-user-{{$user->id}}" action="{{route('admin.user.destroy', $user->id)}}"
                                                   method="post" style="display:none;"
                                            >
                                                @csrf
                                                @method('DELETE')

                                            </form>

                                        </td>
                                    </tr>

                                    @endforeach
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

        function deleteuser(id) {

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
                    document.getElementById('delete-user-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'The user is remain in the system :)',
                        'error'
                    )
                }
            })

        }

    </script>

@endpush
