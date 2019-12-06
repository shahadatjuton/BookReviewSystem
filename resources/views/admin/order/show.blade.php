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
        <a href="{{ route('admin.order.index')}}" class="btn btn-info waves-effect">BACK</a>

        @if($order->status==0)

            <button type="button" name="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $order->id }})">
                <i class="material-icons">done </i>
                <span>Approve</span>
            </button>

            <form  id="approve-post-{{$order->id}}" action="{{route('admin.post.approve', $order->id)}}"
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



        <!-- Vertical Layout | With Floating Label -->


        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                    <tr>

                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Payment Method</th>
                        <th>Status</th>

                        <th>Ordered At</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    @foreach($order->carts as  $order)

                        <tr>
                            <td>{{\App\Post::find($order->post_id)->title}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>
                                @if ($order->status==1)
                                    <span class="badg bg-green">Approved</span>
                                @else
                                    <span class="badg bg-yellow">Pending</span>
                                @endif
                            </td>


                            <td>{{$order->created_at}} At</td>
                            <td>


                                <a class="btn btn-info waves-effect" href="{{route('admin.order.show', $order->id)}}">
                                    <i class="material-icons">visibility </i>
                                </a>

                                <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deletepost({{$order->id}})">
                                    <i class="material-icons" >delete</i>

                                </button>
                                <form  id="delete-post-{{$order->id}}" action="{{route('admin.post.destroy', $order->id)}}"
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
