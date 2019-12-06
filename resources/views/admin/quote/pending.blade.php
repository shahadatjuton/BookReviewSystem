@extends('layouts.backend.master')

@section('title', 'Pending Quotes')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush



@section('content')

    <div class="container-fluid">
        <div class="block-header">


            <a class="btn btn-primary waves-effect" href="{{route('quote.create' )}}">

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
                            <span class="badge bg-blue">{{ $pending_quotes->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Quote</th>
                                    <th>Author</th>
                                    <th>Published By</th>
                                    <th> Status</th>

                                    <th>Created At </th>
                                    <th>Action</th>

                                </tr>
                                </thead>



                                @foreach($pending_quotes as $key=> $quote)

                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{Str::limit($quote->quote,30)}}</td>
                                        <td>{{$quote->author}}</td>
                                        <td>{{$quote->user->name}}</td>
                                        <td>
                                            @if ($quote->status==1)
                                                <span class="badg bg-green">Approved</span>
                                            @else
                                                <span class="badg bg-yellow">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{$quote->created_at}}</td>

                                        <td>
                                            <a class="btn btn-info waves-effect" href="{{route('admin.quote.show', $quote->id)}}">
                                                <i class="material-icons">visibility </i>
                                            </a>

                                            <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deletetag({{$quote->id}})">
                                                <i class="material-icons" >delete</i>

                                            </button>
                                            <form  id="delete-tag-{{$quote->id}}" action="{{route('admin.tag.destroy', $quote->id)}}"
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

