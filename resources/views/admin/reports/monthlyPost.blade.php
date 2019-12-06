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
                <th><i class="material-icons">favorite </i></th>

                <th>Action</th>

            </tr>
            </thead>

            @forelse($last_months_posts as $key=> $post)

                <tr>
                    <td>{{ $key +1 }}</td>
                    <td>{{Str::limit($post->title,15)}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->view_count}}</td>
                    <td>{{$post->favourite_to_users->count()}}</td>

                    <td>

                        <a class="btn btn-info waves-effect" href="{{route('admin.post.show', $post->id)}}">
                            <i class="material-icons">visibility </i>
                        </a>

                        <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="removepost({{$post->id}})">
                            <i class="material-icons" >delete</i>

                        </button>
                        <form  id="remove-post-{{$post->id}}" action="{{route('post.favourite', $post->id)}}"
                               method="post" style="display:none;"
                        >
                            @csrf



                        </form>

                    </td>
                </tr>
            @empty
                <h2>No favourite post found</h2>

                @endforelse
                </thead>




        </table>
    </div>
</div>
</body>
</html>