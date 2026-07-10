<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogs;
use Illuminate\Http\Request;
use App\Models\Homeowners;
use App\Models\Registrations;
use App\Models\Complaints;
use App\Models\Maintenance;
use App\Models\Payments;
use App\Models\Billing;
use App\Models\WaterReading;
use App\Models\Announcement;
use App\Models\Houselots;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHomeowners = Homeowners::count();
        
        $totalPendingRegistrations = Registrations::where('status', 'Pending')->count();
        
        $totalActiveComplaints = Complaints::where('status', 'Pending')->count();
        
        $totalMaintenanceRequests = Maintenance::where('status', 'Pending')->count();
        
        $totalCollectionsAmount = Payments::sum('amount');
        
        $totalUnpaidBillings = Billing::where('status', 'Pending')->count();
        
        $totalWaterReadings = WaterReading::count();
        
        $totalAnnouncements = Announcement::count();

        $recentComplaints = Complaints::with(['membership.homeowner'])
            ->orderBy('submitDate', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $activitylogs = ActivityLogs::with('user.staff')->latest()->take(10)->get();
        $announcements = Announcement::latest()->where('created_at', now())->get();

        $houselots = Houselots::all();
        return view('admin/dashboard', compact(
            'totalHomeowners',
            'totalPendingRegistrations',
            'totalActiveComplaints',
            'totalMaintenanceRequests',
            'totalCollectionsAmount',
            'totalUnpaidBillings',
            'totalWaterReadings',
            'totalAnnouncements',
            'recentComplaints',
            'activitylogs',
            'announcements',
            'houselots',
        ));
    }
}
