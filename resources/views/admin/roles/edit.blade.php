<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 mb-2">Role Name</label>
                            <input type="text" name="name" id="name" class="w-full border border-gray-300 px-4 py-2 rounded" value="{{ old('name', $role->name) }}" required>
                        </div>
                        @if($errors->any())
                            <div class="text-red-400 mb-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <h3 class="text-sm font-bold mt-4 mb-2">Permissions</h3>
                        <div class="grid grid-cols-4 mb-2">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center gap-2 mb-2">
                                        <input {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} type="checkbox" class="rounded" name="permission[]" id="permission-{{ $permission->id }}" value="{{ $permission->name }}">
                                        <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">No permissions found</p>
                            @endif
                        </div>

                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>










