<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Assign Role to ' . $user->name) }}
            </h2>
            <a href="{{ route('users.index') }}"
                class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-sm font-bold mb-2">Roles</h3>
                    
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-4 mb-2">
                            @if ($roles->isNotEmpty())
                            @foreach($roles as $role)
                            <div class="flex items-center gap-2 mb-2">
                                <input type="checkbox" class="rounded" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach

                            @else
                                <p class="text-sm text-gray-500">No roles found</p>
                            @endif
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Assign Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

