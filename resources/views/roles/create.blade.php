<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Role Form </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                
             
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row my-5">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Role Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Role Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
              
             
                <button  class="btn btn-primary ml-3">Submit</button>
                <div class="pull-right">
                    <a class="btn btn-primary ml-5" href="{{ route('roles.index') }}"> Back</a>
                </div>
            </div>
        </form>
            </div>
        </div>
    </div>

</x-app-layout>



</body>

</html>