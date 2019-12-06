@extends('layouts.backend.master')

@section('title', 'Post')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush



@section('content')

    <h1>Show Post</h1>


    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.post.index')}}" class="btn btn-info waves-effect">BACK</a>

        @if($quote->status==0)

            <button type="button" name="button" class="btn btn-success waves-effect ml-4" onclick="approvePost({{ $quote->id }})">
                <i class="material-icons">done </i>
                <span>Approve</span>
            </button>

            <form  id="approve-post-{{$quote->id}}" action="{{route('admin.quote.approve', $quote->id)}}"
                   method="post" style="display:none;"
            >
                @csrf
                @method('PUT')

            </form>

        @else

            <button type="button" name="button" class="bt btn-success ml-4" disabled>
                <i class="material-icons">done </i>
                <span>Approved</span>
            </button>


        @endif
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ $quote->quote}}
                        </h2>
                        <h4>
                            <p class="mt-4">
                                <strong><b>--</b></strong> <span class="ml-4">{{$quote->author}}</span>

                            </p>
                        </h4>
                        <p>
                            <small>posted by <strong><a href="#">{{$quote->user->name}}</a></strong> on {{$quote->created_at->toFormattedDateString()}}</small>
                        </p>

                    </div>
                    <div class="body">
                        {!! $quote->body !!}

                    </div>
                </div>
            </div>

        </div>


        <!-- Vertical Layout | With Floating Label -->

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
