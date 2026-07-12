<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = Maintenance::orderBy('maintenanceID', 'desc')->get();
        return view('admin.maintenance.index', compact('maintenance'));
    }

    public function update($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        if ($maintenance->status === 'Pending'){
            $maintenance->status = 'Acknowledged';
            $maintenance->save();

            return redirect()->back()->with('success', 'Maintenance Request is Acknowledged');
        } else if ($maintenance->status === 'Acknowledged') {
            $maintenance->status = 'Completed';
            $maintenance->save();

            return redirect()->back()->with('success', 'Maintenance Request has been successfully Completed');
        }
        return redirect()->back()->with('error', 'Complaint cannot be updated further.');
    }
}
