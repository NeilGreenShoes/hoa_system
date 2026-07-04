<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function show()
    {
        $user = User::orderBy('userID', 'desc')->paginate(10);

        return view('admin/user/showUsers', compact('user'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin/user/createUser', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'loginEmail' => 'required|email|unique:users,loginEmail',
            'password'   => 'required|min:8',
            'status'    => 'required|in:Active,Inactive',
            'roleID'     => 'required|exists:roles,roleID',
        ]);

        $validatedData['password'] = Hash::make($request->password);
        $validatedData['status']      = $request->status;
        $validatedData['isLoggedIn']  = 0;
        $validatedData['lastSession'] = null;
        $validatedData['roleID']      = $request->roleID;

        User::create($validatedData);

        return redirect()->route('showUsers')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin/user/editUser', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'loginEmail' => 'required|email|unique:users,loginEmail,' . $user->userID . ',userID',
            'password'   => 'nullable|min:8',
            'password_confirmation' => 'nullable|required_with:password|same:password',
            'status'     => 'required|in:Active,Inactive',
            'roleID'     => 'required|exists:roles,roleID',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('showUsers')->with('success', 'User updated successfully.');
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('admin/user/viewUser', compact('user'));
    }

    public function archive($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'Archived';
        $user->save();

        return redirect()->back()->with('success', 'User archived successfully.');
    }

}
