@extends('layouts.backend.master')

@section('title', 'Post')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('assets/backend/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

@endpush


@section('content')

    <h1>Create Post</h1>


    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <form action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add Post

                            </h2>

                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control" name="title" placeholder="{{old('title')}}">
                                    <label class="form-label" for="">Enter unique Post Title</label>

                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Featured Image</label>
                                    <input type="file" id="name" class="form-control" name="image">
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Product Quantity</label>
                                    <input type="number" name="quantity" >
                                </div>
                            </div>



{{--                            <div class="form-group">--}}
{{--                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1">--}}
{{--                                <label for="publish">Publish</label>--}}
{{--                            </div>--}}


                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CATEGORIES & TAGS

                            </h2>

                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label for="">Select Category</label>
                                    <select name="categories[]" class="form-control show-tick" data-live-searche="true" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{ $category->name }}</option>

                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="">Select Tag</label>
                                    <select name="tags[]" class="form-control show-tick" data-live-searche="true" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>

                                        @endforeach

                                    </select>

                                </div>
                            </div>


                            <br>
                            <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.post.index')}}"> Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add Post

                            </h2>

                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="body"></textarea>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Vertical Layout | With Floating Label -->

    </div>


@endsection






@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
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
    </script>

@endpush
