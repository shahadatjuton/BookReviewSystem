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

        @if($post->status==false)

            <button type="button" name="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $post->id }})">
                <i class="material-icons">done </i>
                <span>Approve</span>
            </button>

            <form  id="approve-post-{{$post->id}}" action="{{route('admin.post.approve', $post->id)}}"
                   method="post" style="display:none;"
            >
                @csrf
                @method('PUT')

            </form>

        @else

            <button type="button" name="button" class="bt btn-success pull-right" disabled>
                <i class="material-icons">done </i>
                <span>Approved</span>
            </button>


        @endif
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>


                            {{ $post->title}}
                            <small>posted by <strong><a href="#">{{$post->user->name}}</a></strong> on {{$post->created_at->toFormattedDateString()}}</small>

                        </h2>

                    </div>
                    <div class="body">
                        {!! $post->body !!}

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            CATEGORIES

                        </h2>

                    </div>
                    <div class="body">

                        @foreach( $post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                        @endforeach

                    </div>
                </div>
                <div class="card">
                    <div class="header bg-blue">
                        <h2>
                            Tags

                        </h2>

                    </div>
                    <div class="body">

                        @foreach( $post->tags as $tag)
                            <span class="label bg-blue">{{ $tag->name }}</span>
                        @endforeach

                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Featured Image

                        </h2>

                    </div>
                    <div class="body">

                        <img class="img-responsive thumbnail" src="{{ asset('storage/post/'.$post->image) }}" alt="{{$post->image}}">

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
