@extends('layouts.backend.master')

@section('title', 'Post')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush



@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Categories Table

            </h2>

            <a class="btn btn-primary waves-effect" href="{{route('admin.post.create' )}}">

                <span>Create Post</span>
            </a>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TOTAL POSTS
                            <span class="badge bg-blue">{{ $posts->count() }}</span>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
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
                                    <th>Status</th>

                                    <th>Updated At</th>
                                    <th>Action</th>

                                </tr>
                                </thead>



                                @foreach($posts as $key=> $post)

                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{Str::limit($post->title,15)}}</td>

                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->view_count}}</td>
                                        <td>
                                            @if ($post->status==true)
                                                <span class="badg bg-green">Approved</span>
                                            @else
                                                <span class="badg bg-yellow">Pending</span>
                                            @endif
                                        </td>


                                        <td>{{$post->updated_at}} At</td>
                                        <td>

                                            @if($post->is_approved==false)

                                                <button type="button" name="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                                                    <i class="material-icons">done </i>
                                                    <span>Approve</span>
                                                </button>

                                                <form  id="approve-post-{{$post->id}}" action="{{route('admin.post.approve', $post->id)}}"
                                                       method="post" style="display:none;"
                                                >
                                                    @csrf
                                                    @method('PUT')

                                                </form>


                                            @endif

                                            <a class="btn btn-info waves-effect" href="{{route('admin.post.show', $post->id)}}">
                                                <i class="material-icons">visibility </i>
                                            </a>
                                            <a class="btn btn-info waves-effect" href="{{route('admin.post.edit', $post->id)}}">
                                                <i class="material-icons">edit </i>
                                            </a>

                                            <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deletepost({{$post->id}})">
                                                <i class="material-icons" >delete</i>

                                            </button>
                                            <form  id="delete-post-{{$post->id}}" action="{{route('admin.post.destroy', $post->id)}}"
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
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.all.min.js')}}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });

        // Approve post notification message using toaster
        function approvePost(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You wan't to approve this post!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve this post!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approve-post-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your post remains as unapproved :)',
                        'error'
                    )
                }
            })

        }

    </script>

@endpush

