<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Staff;
use App\Models\Role;
use App\Models\Address;
// use App\Models\ActivityLogs;

class UserController extends Controller
{
    public function show()
    {
        $staff = Staff::orderBy('staffID', 'desc')->paginate(10);

        return view('admin/user/showUsers', compact('staff'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin/user/createUser', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'loginEmail'      => 'required|email|unique:users,loginEmail',
            'password'        => 'required|min:8',
            'confirmPassword' => 'required_with:password|same:password',
            'status'          => 'required|in:Active,Inactive',
            'roleID'          => 'required|exists:roles,roleID',

            'lastName'        => 'required|string|max:255',
            'firstName'       => 'required|string|max:255',
            'middleName'      => 'nullable|string|max:255',
            'dateOfBirth'     => 'required|date',
            'gender'          => 'required|in:Male,Female',
            'maritalStatus'   => 'required|in:Single,Married,Divorced,Widowed',
            'contactNumber'   => 'required|string|max:20',

            'street'          => 'required|string|max:255',
            'barangay'        => 'required|string|max:255',
            'city'            => 'required|string|max:255',
            'province'        => 'required|string|max:255',

            'profile'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
            $imagePath = $request->file('profile')->store('profile', 'public');
        }

        DB::transaction(function () use ($validatedData, $imagePath) {

            $address = Address::create([
                'street'   => $validatedData['street'],
                'barangay' => $validatedData['barangay'],
                'city'     => $validatedData['city'],
                'province' => $validatedData['province'],
            ]);

            $user = User::create([
                'loginEmail'  => $validatedData['loginEmail'],
                'password'    => Hash::make($validatedData['password']),
                'status'      => $validatedData['status'],
                'roleID'      => $validatedData['roleID'],
                'isLoggedIn'  => 0,
                'lastSession' => null,
            ]);

            Staff::create([
                'lastName'      => $validatedData['lastName'],
                'firstName'     => $validatedData['firstName'],
                'middleName'    => $validatedData['middleName'],
                'dateOfBirth'   => $validatedData['dateOfBirth'],
                'gender'        => $validatedData['gender'],
                'maritalStatus' => $validatedData['maritalStatus'],
                'contactNumber' => $validatedData['contactNumber'],
                'email'         => $validatedData['loginEmail'],
                'userID'        => $user->userID,
                'addressID'     => $address->addressID,
                'profileImage'  => $imagePath,
            ]);
        });

        return redirect()
            ->route('showUsers')
            ->with('message', 'Staff profile created successfully.');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $roles = Role::all();
        return view('admin/user/editUser', compact('staff', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::with(['user', 'address'])->findOrFail($id);
        $user = $staff->user;
        $address = $staff->address;

        $validatedData = $request->validate([
            'loginEmail' => 'required|email|unique:users,loginEmail,' . $user->userID . ',userID',
            'password' => 'nullable|min:8',
            'confirmPassword' => 'nullable|required_with:password|same:password',
            'status' => 'required|in:Active,Inactive',
            'roleID' => 'required|exists:roles,roleID',

            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'dateOfBirth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'maritalStatus' => 'required|in:Single,Married,Divorced,Widowed',
            'contactNumber' => 'required|string|max:20',

            'street' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',

            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request, $validatedData, $user, $staff, $address) {

            $user->fill([
                'loginEmail' => $validatedData['loginEmail'],
                'status' => $validatedData['status'],
                'roleID' => $validatedData['roleID'],
            ]);

            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            if ($user->isDirty()) {
                $user->save();
            }

            $address->fill([
                'street' => $validatedData['street'],
                'barangay' => $validatedData['barangay'],
                'city' => $validatedData['city'],
                'province' => $validatedData['province'],
            ]);

            if ($address->isDirty()) {
                $address->save();
            }

            $staff->fill([
                'lastName' => $validatedData['lastName'],
                'firstName' => $validatedData['firstName'],
                'middleName' => $validatedData['middleName'],
                'dateOfBirth' => $validatedData['dateOfBirth'],
                'gender' => $validatedData['gender'],
                'maritalStatus' => $validatedData['maritalStatus'],
                'contactNumber' => $validatedData['contactNumber'],
                'email' => $validatedData['loginEmail'],
            ]);

            if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
                $staff->profileImage = $request->file('profile')->store('profile', 'public');
            }

            if ($staff->isDirty()) {
                $staff->save();
            }
        });

        return redirect()
            ->route('showUsers')
            ->with('message', 'Staff profile updated successfully.');
    }
    public function view($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin/user/viewUser', compact('staff'));
    }

    public function archive($id)
    {
        $staff = Staff::findOrFail($id);
        $user = User::findOrFail($staff->user->userID);
        $user->status = 'Archived';
        $user->save();

        return redirect()->back()->with('message', 'User archived successfully.');
    }

}
