<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(10);

        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|unique:roles,name'
        ]);

        if($validator->passes())
        {
            $role = Role::create(['name' => $request->name]);

            if(!empty($request->permission))
            {
                foreach($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('roles.index')->with('success', 'Role added successfully');
        }

        return redirect()->route('roles.create')->withErrors($validator)->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('admin.roles.edit', ['role' => $role, 'hasPermissions' => $hasPermissions, 'permissions' => $permissions]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|unique:roles,name,'.$id
        ]);

        if($validator->passes()) {
            $role->update(['name' => $request->name]);

            if(!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            }
            else {
                $role->syncPermissions([]);
            }

            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        }

        return redirect()->route('roles.edit', $id)->withErrors($validator)->withInput();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

        if($role->delete())
        {
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        }

        return redirect()->route('roles.index')->with('error', 'Role not found');

    }
}
