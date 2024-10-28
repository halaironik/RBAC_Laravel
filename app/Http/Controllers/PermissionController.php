<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|unique:permissions,name'
        ]);

        if($validator->passes())
        {
            Permission::create(['name' => $request->name]);

            return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
        }

        return redirect()->route('permissions.create')->withErrors($validator)->withInput();

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $permission = Permission::findOrFail($id);

       return view('admin.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|unique:permissions,name,' . $id
        ]);

        if($validator->passes())
        {
            $permission->update(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
        }
        return redirect()->route('permissions.edit', $id)->withErrors($validator)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {

        if($permission->delete())
        {
            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
        }

        return redirect()->route('permissions.index')->with('error', 'Permission not found');
    }
}
