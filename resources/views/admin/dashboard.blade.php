<script src="{{ asset('resources/js/admin/dashboard.js')}}"></script>
<link rel="stylesheet" href="{{ asset('resources/css/admin/dashboard.css') }}">
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

        <div class="container-activity-logs">
            <h2>ACTIVITY LOGS</h2>
            <div>
                <table class="table table-complaints">
                    <thead>
                        <tr>
                            <th>Homeowner</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activitylogs as $activitylog)
                            <tr>
                                <td class="logs-name">
                                    @if($activitylog->user  && $activitylog->user->staff)
                                        {{ $activitylog->user->staff->name() }}
                                    @else
                                        <span>Unknown User</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $activitylog->description}}
                                </td>

                                <td>
                                    {{ $activitylog->created_at->format('M d, Y')}}
                                </td>
                            </tr> 
                        @empty
                            <tr class="no-activities">
                                <td colspan="4">No recent activities logged.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-announcments">
            <h2>ANNOUNCEMENT</h2>
            <div>
                <table class="table table-announcement">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Target</th>
                            <th>Posted on</th>
                            <th>Posted by</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td>{{ $announcement->title}}</td>
                                <td class="description-cell">{{ $announcement->description}}</td>
                                <td>{{ $announcement->targetType}}</td>
                                <td>{{ $announcement->created_at->format('M d, Y')}}</td>
                                <td class="announcment-name">
                                    @if($announcement->staff)
                                        {{ $announcement->staff->name() }}
                                    @else
                                        <span>Unknown Staff</span>
                                    @endif
                                </td>
                            </tr>     
                        @empty
                            <tr class="no-activities">
                                <td colspan="4">No recent activities logged.</td>
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