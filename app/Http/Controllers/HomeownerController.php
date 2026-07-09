<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Homeowners;
use App\Models\Registrations;
use App\Services\FirebaseService;

class HomeownerController extends Controller
{
    public function index() 
    {
        $homeowners = Homeowners::latest()->paginate('10');

        return view('admin.homeowner.index', compact('homeowners'));
    }

    public function pending()
    {
        $registrations = Registrations::latest()->where('status', 'Pending')->get();
        // dd($registrations);

        return view('admin.homeowner.pending', compact('registrations'));
    }

    public function approveRegistration($id)
    {
        $registration = Registrations::findOrFail($id);

        $registration->status = 'Approved';
        $registration->save();

        $user = $registration->user;

        Homeowners::create([
            'firstName'      => 'N/A',
            'middleName'     => NULL,
            'lastName'       => 'N/A',
            'dateOfBirth'    => now(),
            'gender'         => 'Male',
            'religion'       => NULL,
            'maritalStatus'  => 'Single',
            'contactNumber'  => 'N/A',
            'email'          => $user->loginEmail,
            'profileImage'   => 'N/A',
            'userID'         => $registration->userID,
            'addressID'      => '23',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->back()->with('success', 'Homeowner Registration Approved');
    }

    public function rejectRegistration($id){
        $registration = Registrations::findOrFail($id);

        $registration->status = 'Rejected';
        $registration->save();

        return redirect()->back()->with('success', 'Homeowner Registration Rejected');
    }

    public function requestUpdateProfile($id){
        $homeowner = Homeowners::findOrFail($id);
        // send service to mobile app with request for update

        return redirect()->back()->with('success', 'Request sent to homeowner!');
    }

    public function show($id){
        $homeowner = Homeowners::findOrFail($id);

        return view('admin.homeowner.show', compact('homeowner'));
    }
}
