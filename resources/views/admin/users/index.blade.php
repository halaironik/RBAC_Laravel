<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <x-confirmation />

                @if ($users->isNotEmpty())
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-3 text-left" width="65">ID</th>
                                <th class="px-4 py-3 text-left">User</th>
                                <th class="px-4 py-3 text-left">Roles</th>
                                <th class="px-4 py-3 text-left">Permissions</th>
                                <th class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($users as $user)
                                <tr class="border-b">
                                    <td class="px-4 py-3 text-left">{{ $count }}</td>
                                    <td class="px-4 py-3 text-left">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-left">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                    <td class="px-4 py-3 text-left">{{ $user->getAllPermissions()->pluck('name')->implode(', ') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center items-center"><a href="{{ route('users.edit', $user->id) }}" class="bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600">Assign Role</a></div>
                                    </td>
                                </tr>

                                @php
                                    $count++;
                                @endphp
                            @endforeach
                        </tbody>


                    </table>
                @else
                    <p class="text-center text-gray-500">No users found</p>
                @endif

            </div>
            <div class="mt-3">{{ $users->links() }}</div>
        </div>
    </div>

</x-app-layout>
