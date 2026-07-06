@php
    $dashboardJsPath = file_exists(public_path('js/admin/dashboard.js'))
        ? asset('js/admin/dashboard.js')
        : asset('js/dashboard.js');

    $dashboardCssPath = file_exists(public_path('css/admin/dashboard.css'))
        ? asset('css/admin/dashboard.css')
        : asset('css/dashboard.css');
@endphp

<script src="{{ $dashboardJsPath }}"></script>
<link rel="stylesheet" href="{{ $dashboardCssPath }}">
<x-admin>
    <x-view-header title="Dashboard">
        
    </x-view-header>

    <div class="container-dashboard">
        <div class="container-info">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>Use the navigation menu to manage users, roles, and other administrative tasks.</p>
        </div>

        <hr />

        <div class="container-metrics">
            <div class="metric-card">
                <span>Total Homeowners</span>
                <h2>{{ $totalHomeowners }}</h2>
            </div>

            <div class="metric-card">
                <span>Pending Registrations</span>
                <h2>{{ $totalPendingRegistrations }}</h2>
            </div>

            <div class="metric-card">
                <span>Active Complaints</span>
                <h2>{{ $totalActiveComplaints }}</h2>
            </div>

            <div class="metric-card">
                <span>Maintenance Requests</span>
                <h2>{{ $totalMaintenanceRequests }}</h2>
            </div>

            <div class="metric-card">
                <span >Total Collections</span>
                <h2 >₱{{ number_format($totalCollectionsAmount, 2) }}</h2>
            </div>

            <div class="metric-card" >
                <span>Unpaid Billings</span>
                <h2 >{{ $totalUnpaidBillings }}</h2>
            </div>

            <div class="metric-card">
                <span>Water Readings</span>
                <h2>{{ $totalWaterReadings }}</h2>
            </div>

            <div class="metric-card">
                <span >Announcements</span>
                <h2 >{{ $totalAnnouncements }}</h2>
            </div>
        </div>
        <div class="container-complaints">
            <h2>Recent Complaints</h2>
            <div>
                <table class="table-complaints">
                    <thead>
                        <tr>
                            <th>Homeowner</th>
                            <th>Subject/Title</th>
                            <th>Status</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentComplaints as $complaint)
                            <tr>
                                <td class="homeowner-name">
                                    @if($complaint->membership && $complaint->membership->homeowner)
                                        {{ $complaint->membership->homeowner->firstName }} {{ $complaint->membership->homeowner->lastName }}
                                    @else
                                        <span>Unknown Homeowner</span>
                                    @endif
                                </td>
                                <td><strong>{{ $complaint->title }}</strong></td>
                                <td class="complaint-status">
                                    <span>
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                                <td class="complaint-date">
                                    {{ \Carbon\Carbon::parse($complaint->submitDate)->format('M d, Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr class="no-complaints">
                                <td colspan="4">No recent complaints logged.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container-visualizations">
            <h2>Visualizations</h2>
            <div class="chart-container">
                <canvas id="complaintsChart"></canvas>
            </div>
        </div>
    </div>
</x-admin>