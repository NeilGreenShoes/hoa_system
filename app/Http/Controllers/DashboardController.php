<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homeowners;
use App\Models\Registrations;
use App\Models\Complaints;
use App\Models\Maintenance;
use App\Models\Payments;
use App\Models\Billing;
use App\Models\WaterReading;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Gather Total Counts & Financial Aggregations
        $totalHomeowners = Homeowners::count();
        
        $totalPendingRegistrations = Registrations::where('status', 'Pending')->count();
        
        $totalActiveComplaints = Complaints::where('status', 'Pending')->count();
        
        $totalMaintenanceRequests = Maintenance::where('status', 'Pending')->count();
        
        $totalCollectionsAmount = Payments::sum('amount');
        
        $totalUnpaidBillings = Billing::where('status', 'Pending')->count();
        
        $totalWaterReadings = WaterReading::count();
        
        $totalAnnouncements = Announcement::count();

        // 2. Fetch Recent Complaints with exact model relationship chains
        // Eager loading membership -> homeowner to get the creator's identity cleanly
        $recentComplaints = Complaints::with(['membership.homeowner'])
            ->orderBy('submitDate', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Compact metrics and deliver data straight to your blade panel
        return view('admin/dashboard', compact(
            'totalHomeowners',
            'totalPendingRegistrations',
            'totalActiveComplaints',
            'totalMaintenanceRequests',
            'totalCollectionsAmount',
            'totalUnpaidBillings',
            'totalWaterReadings',
            'totalAnnouncements',
            'recentComplaints'
        ));
    }
}
