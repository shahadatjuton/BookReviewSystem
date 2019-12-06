<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-mail Notification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
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



            @foreach($last_months_posts as $key=> $post)

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
</body>
</html>