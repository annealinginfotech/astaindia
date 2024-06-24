<?php

namespace App\Http\Controllers\Roles_And_Permissions;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Permission;


class RolesController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->get();
        $data   =   [
            'title'     =>  'Roles',
            'roles'     =>  $roles
        ];

        return view('roles.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionRaw = Permission::get();

        $permission     =   $permissionRaw->mapToGroups(function($item) {
            return [$item['group_name'] =>  ['id' => (int)$item['id'], 'name' => $item['name']]];
        });

        $data   =   [
            'title'     =>  'Create new role',
            'permissions'   =>  $permission->all()
        ];

        return view('roles.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        $selectedPermissionSets =   array_map('intval', $request->input('permission'));

        $role->syncPermissions($selectedPermissionSets);

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissionRaw = Permission::get();

        $permissions     =   $permissionRaw->mapToGroups(function($item) {
            return [$item['group_name'] =>  ['id' => (int)$item['id'], 'name' => $item['name']]];
        });

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $data               =   [
            'title'                 =>  'View Role',
            'role'                  =>  $role,
            'permissions'           =>  $permissions,
            'assignedPermission'    =>  $rolePermissions
        ];

        return view('roles.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $selectedPermissionSets =   array_map('intval', $request->input('permission'));
        $role->syncPermissions($selectedPermissionSets);

        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('deleted','Role deleted successfully.');
    }
}
