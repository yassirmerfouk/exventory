<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Empty_;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.users', ['users' => $users]);
    }

    public function userAddPage()
    {
        $roles = Role::all();
        return view('users.adduser', ['roles' => $roles]);
    }

    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:250',
            'last_name' => 'required|max:250',
            'email' => 'required|max:250|unique:users',
            'password' => 'required|max:250',
            'roles' => 'required'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->roles);
        session()->flash('Add', 'Successful user add');
        return redirect('/home/users');
    }

    public function userUpdatePage($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.modifyuser', ['user' => $user, 'roles' => $roles]);
    }

    public function updateUser($id, Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:250',
            'last_name' => 'required|max:250',
            'email' => 'required|max:250|unique:users,email,' . $id,
            'roles' => 'required'
        ]);

        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ]);

        if (!empty($request->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $user->syncRoles($request->roles);
        session()->flash('Add', 'Successful user update');
        return redirect('/home/users');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();

        session()->flash('Delete', 'Successful user delete');
        return redirect('/home/users');
    }
}
