<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container my-4">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">

                                <div class="pull-right mb-2">
                                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create Role</a>
                                </div>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))

                        <div class="alert alert-success" id="message_id">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        @if ($error = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $error }}</p>
                        </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>Sr. No</th>
                                <th>Role</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $roles->firstItem() + $loop->index }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <form action="{{ route('roles.destroy',$role->id) }}" method="Post">
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                        <a class="btn btn-info " href="{{route('roles.show',$role->id)}}">Show</a>

                                         
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        {!! $roles->links() !!}
                    </div>
                </div>
            </div>

    </x-app-layout>
</body>

</html>