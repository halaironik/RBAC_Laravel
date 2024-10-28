<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->with('roles', 'permissions')->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    public function edit(String $id) {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, String $id) {

        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'role' => 'required|array',
        ]);

        if($validator->fails()) {
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        }

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'Role updated successfully');
    }
}
