<?php
<table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Roles</th>
                <th class="border px-4 py-2">Permissions</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">
                        @foreach($user->roles as $role)
                            <span class="bg-gray-200 px-2 py-1 rounded">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        @foreach($user->getAllPermissions() as $permission)
                            <span class="bg-gray-200 px-2 py-1 rounded">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Assign Role</a>
                    </td>
                </tr>
            @endforeach
        </tbody>