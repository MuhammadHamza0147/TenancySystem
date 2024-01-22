<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('app.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('app.users.create' , compact('roles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User Created Successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $roles = Role::all();
        $userEdit = User::with('roles')->find($id);
        return view('app.users.create' , compact('userEdit' , 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users,email,'.$id,
            'role' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User Updated Successfully');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    }
}
