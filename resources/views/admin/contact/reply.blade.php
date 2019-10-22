@extends('layouts.backend.master')

@section('title', 'Message-Reply')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush



@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="message">
                    <p class="text-center">{{$messages->message}}</p>
                    <p class="text-center">by <span><b>{{$messages->first_name}}</b></span> on <span><b>{{$messages->created_at}}</b></span></p>

                </div>
                <div class="reply">
                    <form action="{{route('admin.contact.ReplyMessage',$messages->id)}}" method="post">
                        @csrf
                        <div class="row text-center">
                            <div class="col-md-12 form-group">
                                <textarea name="reply" id="message"  cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                <input type="submit" value="Reply" class="btn btn-primary btn-lg px-5">
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
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

        function deletemessage(id) {

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
                    document.getElementById('delete-message-' + id).submit();
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
