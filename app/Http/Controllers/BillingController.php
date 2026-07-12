<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Houselots;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $bill = Billing::orderBy('billingID', 'desc')->get();

        $total_collected = Billing::where('status', 'Paid')->sum('totalAmount');
        $total_unpaid = Billing::whereNot('status', 'Paid')->sum('totalAmount');
        $total = Billing::count();

        return view('admin.billing.index', compact('bill', 'total_collected', 'total_unpaid', 'total'));
    }

    public function create()
    {
        $lot = Houselots::get();
        return view('admin.billing.create', compact('lot'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'homeowner' => 'required|exists:lots,homeownerID', 
            'date'      => 'required|date|after_or_equal:today',

            'monthly'     => 'required_without_all:security,penalty,reconnection,arrear|boolean',
            'security'    => 'required_without_all:monthly,penalty,reconnection,arrear|boolean',
            'penalty'     => 'required_without_all:monthly,security,reconnection,arrear|boolean',
            'reconnection'       => 'required_without_all:monthly,security,penalty,arrear|boolean',
            'arrear' => 'required_without_all:monthly,security,penalty,reconnection|boolean',
        ], [
            'homeowner.required' => 'Please select a homeowner.',
            'date.required'      => 'A due date is required.',
            'monthly.required_without_all' => 'You must check at least one fee item to create a billing.',
        ]);

        $billing = new Billing();
        $billing->homeownerID = $request->input('homeowner');
        $billing->dueDate = $request->input('date');
        $billing->monthlyDue = $request->has('monthly');
        $billing->securityFee = $request->has('security');
        $billing->penaltyFee = $request->has('penalty');
        $billing->reconnectionFee = $request->has('reconnection');
        $billing->arrears = $request->has('arrear');
        $billing->totalAmount = $request->sum('monthly', 'security', 'penalty', 'reconnection', 'arrear');
        $billing->save();

        return redirect()->route('admin.billing.index')->with('success', 'Billing statement created successfully!');
    }
}
