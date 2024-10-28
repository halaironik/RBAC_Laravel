<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <a href="{{ route('permissions.create') }}"
                class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600">New Permission</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <x-confirmation />
                @if ($permissions->isNotEmpty())
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-3 text-left" width="65">ID</th>
                                <th class="px-4 py-3 text-left">Name</th>
                                <th class="px-4 py-3 text-left">Created On</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($permissions as $permission)
                                <tr class="border-b">
                                    <td class="px-4 py-3 text-left">{{ $count }}</td>
                                    <td class="px-4 py-3 text-left">{{ $permission->name }}</td>
                                    <td class="px-4 py-3 text-left">{{ $permission->created_at->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                                class="bg-gray-600 text-white px-3 py-2 rounded-md hover:bg-gray-500 mx-2">Edit</a>
                                            <button type="submit" form="delete-form-{{ $permission->id }}" class="bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-500">Delete</button>
                                        </div>
                                    </td>
                                </tr>

                                @php
                                    $count++;
                                @endphp

                                <form action="{{ route('permissions.destroy', $permission) }}" method="POST" id="delete-form-{{ $permission->id }}" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            @endforeach

                        </tbody>
                    </table>
                @else
                    <p class="text-center mt-4">No permissions found</p>
                @endif
            </div>
            <div class="mt-3">{{ $permissions->links() }}</div>
        </div>
    </div>

</x-app-layout>
