<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <a href="{{ route('roles.create') }}" class="mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                        Create
                    </a>
                    @if(session()->has('success'))
                        <script>
                            swal({
                                title: '{{ session()->get('success') }}',
                                icon: "success",
                             })
                        </script>
                    @endif
                    <div class="align-middle mt-3">
                        <table class="table-striped table-bordered data display nowrap" id="roles_table" style="max-width: 1000px;">
                            <thead>
                                <tr class="text-center font-bold">
                                    <th class="px-6 py-3 border">
                                        Sr.No.
                                    <th class="px-6 py-3 border">
                                        Role
                                    </th>
                                    <th class="px-6 py-3 border">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
  $(function () {
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('#roles_table').DataTable({
        processing: true,
        serverSide: true,
        responsive:true,
        ajax: {
            url:"{{ route('roles.index') }}",
            data:function (d){
                d.role = $('.searchRole').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            // {render: function (data, type, row, meta) {
                
            //     return meta.row + meta.settings._iDisplayStart + 1;
            //     }
            // },
            {data: 'id', name: 'id'},
            {data: 'name', name: 'role'},
            {data: 'action', name: 'action', orderable: false, searchable: true},
        ],
    });
});
$(document).on('click', '.delete-btn', function (e) {                
    e.preventDefault();
    var url = $(e).data('url');

    return swal({
        title: 'Are you sure?',
        text: 'Once deleted, you will not be able to recover this !',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $('#delete_form').submit();
        } 
    });            
});
</script>  


