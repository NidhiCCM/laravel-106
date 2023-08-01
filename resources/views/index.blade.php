<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles Modal') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                <form action="{{ url('roles-modal') }}" method="POST">
@csrf
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@if (Session::has('success'))
<div class="alert alert-success text-center">
<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
<p>{{ Session::get('success') }}</p>
</div>
@endif
<table class="table table-bordered" id="dynamicAddRemove">  
<tr>
<th>Title</th>
<th>Action</th>
</tr>
<tr>  
<td><input type="text" name="moreFields[0][name]" placeholder="Enter role" class="form-control" /></td>  
<td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>  
</tr>  
</table> 
<button type="submit" class="btn btn-success">Save</button>
</form>
                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
var i = 0;
$("#add-btn").click(function(){
++i;
$("#dynamicAddRemove").append('<tr><td><input type="text" name="moreFields['+i+'][name]" placeholder="Enter role" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  
</script>