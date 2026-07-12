<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $high = Complaints::where('severityLevel', 'High')->count();
        $mid = Complaints::where('severityLevel', 'Medium')->count();
        $low = Complaints::where('severityLevel', 'Low')->count();

        $complaint = Complaints::orderBy('complaintID', 'desc')
        ->when($request->filled('severity'), function ($query) use ($request) {
            return $query->where('severityLevel', $request->severity);
        })
        ->when($request->filled('status'), function ($query) use ($request) {
            return $query->where('status', $request->status);
        })
        ->get();

        
        return view('admin.complaint.index', compact('low', 'mid', 'high', 'complaint'));
    }

    public function update($id)
    {
        $complaint = Complaints::findOrFail($id);

        if ($complaint->status === 'Pending'){
            $complaint->status = 'Acknowledged';
            $complaint->save();

            return redirect()->back()->with('success', 'Complaint Successfully Acknowledged');
        } else if ($complaint->status === 'Acknowledged') {
            $complaint->status = 'Resolved';
            $complaint->save();

            return redirect()->back()->with('success', 'Complaint Successfully Resolved');
        }
        return redirect()->back()->with('error', 'Complaint cannot be updated further.');
    }
}
