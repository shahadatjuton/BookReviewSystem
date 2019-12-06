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
                <th>Name</th>
                <th>Role</th>
                <th>Created At </th>
                <th>Updated At</th>
                <th>Action</th>

            </tr>
            </thead>



            @foreach($users as $key=> $user)


                <tr>
                    <td>{{ $key +1 }}</td>
                    <td>{{$user->name}}</td>
                    @if($user->role_id == 1)
                        <td>Admin</td>
                    @elseif ($user->role_id ==2)
                        <td>Publisher</td>
                    @elseif($user->role_id ==3)
                        <td>Author</td>
                    @elseif($user->role_id ==4)
                        <td>Reader</td>
                    @endif
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>

                        <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deleteuser({{$user->id}})">
                            <i class="material-icons" >delete</i>

                        </button>
                        <form  id="delete-user-{{$user->id}}" action="{{route('admin.user.destroy', $user->id)}}"
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