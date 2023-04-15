<?php

namespace App\Http\Controllers\Role;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.roles', ['roles' => $roles]);
    }

    public function roleAddPage()
    {
        $permissions = Permission::all();
        return view('roles.addrole', ['permissions' => $permissions]);
    }

    public function addRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:roles',
            'permissions' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->givePermissionTo($request->permissions);

        session()->flash('Add', 'Successful role add');
        return redirect('/home/roles');
    }

    public function roleUpdatePage($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.modifyrole', ['role' => $role, 'permissions' => $permissions]);
    }

    public function updateRole($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:roles,name,' . $id,
            'permissions' => 'required'
        ]);

        $role = Role::find($id);
        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        session()->flash('Update', 'Successful role update');
        return redirect('/home/roles');
    }


    public function deleteRole($id)
    {
        Role::find($id)->delete();
        session()->flash('Delete', 'Successful role delete');
        return redirect('/home/roles');
    }
}
