<script src="{{ asset('resources/js/admin/dashboard.js')}}?v={{ filemtime(resource_path('js/admin/dashboard.js')) }}"></script>
<link rel="stylesheet" href="{{ asset('resources/css/admin/dashboard.css') }}?v={{ filemtime(resource_path('css/admin/dashboard.css')) }}">
<x-admin>
    {{-- <x-view-header title="Dashboard">
        
    </x-view-header> --}}

    <div class="container-dashboard">
        <div class="container-info">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>Use the navigation menu to manage users, roles, and other administrative tasks.</p>
        </div>

        <hr />
        <h1 class="title">OVERVIEW</h1>
        <br>
        <div class="container-metrics">
            
            <div class="metric-card">
                <div class="icon"><i class="fa-solid fa-user-group fa-xl"></i></div>
                <h2>{{ $totalHomeowners }}</h2>
                <span class="text">Total Homeowners</span>
            </div>

            <div class="metric-card">
                <div class="icon"><i class="fa-regular fa-clipboard fa-xl"></i></div>
                <h2>{{ $totalPendingRegistrations }}</h2>
                <span class="text">Pending Registrations</span>
            </div>

            <div class="metric-card">
                <div class="icon"><i class="fa-solid fa-triangle-exclamation fa-xl"></i></div>
                <h2>{{ $totalActiveComplaints }}</h2>
                <span class="text">Active Complaints</span>
            </div>

            <div class="metric-card">
                <div class="icon"><i class="fa-solid fa-wrench fa-xl"></i></div>
                <h2>{{ $totalMaintenanceRequests }}</h2>
                <span class="text">TMaintenance Requests</span>
            </div>

            <div class="metric-card">
                <div class="icon"><i class="fa-solid fa-arrow-trend-up fa-xl"></i></div>
                <h2 >₱{{ number_format($totalCollectionsAmount, 2) }}</h2>
                <span class="text">Total Collections</span>
            </div>

            <div class="metric-card" >
                <div class="icon"><i class="fa-solid fa-coins fa-xl"></i></div>
                <h2 >{{ $totalUnpaidBillings }}</h2>
                <span class="text">Unpaid Billings</span>
            </div>

            <div class="metric-card">
                <div class="icon"><i class="fa-solid fa-gauge fa-xl"></i></div>
                <h2>{{ $totalWaterReadings }}</h2>
                <span class="text">Water Readings</span>
            </div>

            <div class="metric-card">
                <div class="icon"><i class="fa-solid fa-bullhorn fa-xl"></i></div>
                <h2 >{{ $totalAnnouncements }}</h2>
                <span class="text">Announcements</span>
            </div>
        </div>
        <div class="container-complaint-logs">
            <div class="container-complaints">
                <div class="complaint-header">
                    <h2 class="title">Recent Complaints</h2>
                    <a>View All</a>
                </div>
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
                <h2 class="title">ACTIVITY LOGS</h2>
                <div class="container-log-rows">
                    @forelse ($activitylogs as $activitylog)
                        <div class="log-row">
                            <div class="log-row-icon"><i class="fa-solid fa-circle"></i></div>
                            <div class="log-row-text">
                                <div class="log-row-name">
                                    @if($activitylog->user  && $activitylog->user->staff)
                                        {{ $activitylog->user->staff->name() }}
                                    @else
                                        <span>Unknown User</span>
                                    @endif
                                </div>
                                <div class="log-row-desc">
                                    {{ $activitylog->description}}
                                    {{ $activitylog->created_at->format('M d, Y')}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-activities">
                            <p>No recent activities logged.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="container-announcements">
            <h2 class="title">ANNOUNCEMENT</h2>
            <div class="card-container">
                @forelse ($announcements as $announcement)
                    <div class="card-anc">
                        <div class="card-anc-header">
                            <h2 class="target-badge target-{{ strtolower($announcement->targetType) }}">
                                {{ $announcement->targetType }}
                            </h2>
                            <p>{{ $announcement->created_at->format('M d, Y')}}</p>
                        </div>
                        <div class="card-anc-text">
                            <h1>{{ $announcement->title}}</h1>
                            <p>{{ $announcement->description}}</p>
                        </div>
                    </div>  
                @empty
                    <div class="no-activities">
                        <td colspan="4">No recent announcements.</td>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="container-monitoring">
            <h2 class="title">House & Lot Monitoring</h2>
            <p>Valeen Vista Subdivision - 14 Blocks, 51 Lots, System generated status
            <div class="monitoring-kanban">
                <div class="monitoring-card">
                   <strong> {{$houselots->count()}} </strong>
                    Total Lots
                </div>
                <div class="monitoring-card">
                   <strong> {{$totalHomeowners}} </strong>
                    Registered
                </div>
                <div class="monitoring-card">
                   <strong> {{$houselots->where('occupancyStatus', 'Occupied')->count()}} </strong>
                    Occupied
                </div>
                <div class="monitoring-card">
                   <strong> {{$houselots->where('occupancyStatus', 'Vacant')->count()}} </strong>
                    Vacant
                </div>
                <div class="monitoring-card">
                   <strong> {{$houselots->where('occupancyStatus', 'Vacant')->count()}} </strong>
                    Vacant
                </div>
                <div class="monitoring-card">
                   <strong> {{$houselots->where('occupancyStatus', 'Vacant')->count()}} </strong>
                    Vacant
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <td>BLOCK / LOT</td>
                            <td>OWNER NAME</td>
                            <td>VACANCY STATUS</td>
                            <td>LOT OWNERSHIP STATUS</td>
                            <td>OCCUPIER STATUS</td>
                            <td>MEMBERS</td>
                            <td>RENTERS</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($houselots as $lots)
                            <tr>
                                <td>BLK. {{ $lots->blockNumber }} LT. {{ $lots->lotNumber }}</td>
                                
                                <td>{{ $lots->homeowner->fullname() }}</td>
                                
                                <td>
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $lots->occupancyStatus)) }}">
                                        {{ $lots->occupancyStatus }}
                                    </span>
                                </td>
                                
                                <td>{{ $lots->ownership_status }}</td>
                                
                                <td>{{ $lots->occupier_status }}</td>
                                
                                <td>{{ $lots->members->count() ?? 0 }} Members</td>
                                
                                <td>{{ $lots->renters ?? 'None' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: #888;">No Homeowners found</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin>