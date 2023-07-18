<x-app-layout>
<x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Info') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
              
                        <div class="p-6 text-gray-900">                        
                            <div class="">
                            <strong>  Role Name:</strong>
                            {{ $role->name }}
                            </div>
                        </div>       
                        </div>
                        <div class="flex items-center justify-center h-screen mt-3">
                            <div class=" ml-3 ">
                                <a href="{{ route('roles.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                    Back
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

