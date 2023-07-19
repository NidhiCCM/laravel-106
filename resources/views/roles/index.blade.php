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
                    @if ($message = Session::get('success'))
                        <div class="alert">
                            <p class="ml-3 text-sm font-bold text-green-600">{{ session('success')}}</p>
                        </div>
                    @endif
                    <div class="w-screen align-middle mt-3">
                        <table class="w-full border mt-3" id="roles_table">
                            <thead>
                                <tr class="text-center font-bold">
                                    <th class="px-6 py-3 border">
                                        Sr.No.
                                    <th class="px-6 py-3 border">
                                        Role
                                    </th>
                                    <th class="w-56 px-6 py-3 border">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="border px-6 py-4 text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="border px-6 py-4">
                                            {{ $role->name }}
                                        </td>
                                        <td class="px-6 py-4 border text-center">
                                            <a href="{{ route('roles.edit', $role) }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                Edit
                                            </a>
                                            <a href="{{ route('roles.show', $role) }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                Show
                                            </a>
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>
                                                    Delete
                                                </x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    let table = new DataTable('#roles_table');

    $("document").ready(function() {
        setTimeout(function() {
            $("div.alert").remove();
        }, 2000);
    });
</script>