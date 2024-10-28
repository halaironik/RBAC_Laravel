<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Role') }}
        </h2>
        <a href="{{ route('roles.index') }}"
                class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600">Back</a>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="block text-gray-700 mb-2">Role Name</label>
                            <input type="text" name="name" id="name" class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg" value="{{ old('name') }}" required>
                        </div>

                        @if($errors->any())
                            <div class="text-red-400 mb-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        <h3 class="text-sm font-bold mt-4 mb-2">Permissions</h3>
                        <div class="grid grid-cols-4 gap-4">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center gap-2 mb-4">
                                        <input type="checkbox" class="rounded" name="permission[]" id="permission-{{ $permission->id }}" value="{{ $permission->name }}">
                                        <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">No permissions found</p>
                            @endif
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create Role</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
