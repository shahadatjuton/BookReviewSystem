@extends('layouts.backend.master')

@section('title', 'Post-Comments')

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
                        All COMMENTS
                        <span class="badge bg-blue">0</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Comment Info</th>
                                <th>Post Info</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($posts as $key=> $post)
                                @foreach($post->comments as $comment)

                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="">
                                                    <img  class="media-object" src="{{ asset('storage/profile/'.$comment->user->image) }}" width="64" height="64" alt="profile image">
                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    {{ $comment->user->name }}
                                                    <small>{{ $comment->created_at->diffForHumans() }}</small>

                                                </h4>
                                                <p>{{$comment->comment}}</p>
                                                <a href="{{route('post.details',$comment->post->slug)}}">
                                                    Reply
                                                </a>

                                            </div>

                                        </div>
                                    </td>


                                    <td>
                                        <div class="media">
                                            <div class="media-right">
                                                <a target="_blank" href="{{route('post.details',$comment->post->slug)}}">
                                                    <img  class="media-object" src="{{ asset('storage/post/'.$comment->post->image) }}" width="64" height="64" alt="profile image">
                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <a target="_blank" href="{{route('post.details',$comment->post->slug)}}">
                                                    <h4 class="media-heading">
                                                        {{ Str::limit ($comment->post->title, '40' )}}


                                                    </h4>
                                                </a>

                                                <p> By <strong>{{ $comment->post->user->name }}</strong></p>
                                            </div>

                                        </div>

                                    </td>
                                    <td>

                                        <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deletecomment({{$comment->id}})">
                                            <i class="material-icons" >delete</i>

                                        </button>
                                        <form  id="delete-comment-{{$comment->id}}" method="post" action="{{'admin.comment.destroy'}}" style="display:none;"
                                        >
                                            @csrf
                                            @method('DELETE')



                                        </form>

                                    </td>
                                </tr>



                                @endforeach
                                        @endforeach
                               </tbody>




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

        function deletecomment(id) {

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
                    document.getElementById('delete-comment-' + id).submit();
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
