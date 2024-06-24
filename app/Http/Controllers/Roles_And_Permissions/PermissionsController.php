<?php

namespace App\Http\Controllers\Roles_And_Permissions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::all();

        $data       =   [
            'title'         =>  'Permissions',
            'permissions'   =>  $permission
        ];

        return view('Permissions.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permission_name'          =>  'required|unique:permissions,name',
            'permission_group_name'    =>  'required'
        ]);

        Permission::updateOrcreate(['id'    =>  $request->permission_id],[
            'group_name'    =>  $request->input('permission_group_name'),
            'name'          =>  $request->input('permission_name'),
            'guard'         =>  'web'
        ]);

        return redirect()->route('permissions.index')
            ->with('success','Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return $permission;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('deleted', 'Permission deleted successfully');
    }
}
