<link rel="stylesheet" href="{{ asset('resources/css/admin/complaint/index.css')}}?v={{ filemtime(resource_path('css/admin/complaint/index.css')) }}">
<x-admin>
    <x-view-header title="Complaint Management">

    </x-view-header>

    @if($high > 10)
            <div class="severity">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div class="severity-text">
                    <h1>High Severity Level</h1>
                    <p>The system has detected an unmanageable volume of high-level complaints. The critical safety threshold has been breached. Immediate executive and technical intervention is required to mitigate active operational, legal, and brand risk.</p>
                </div>
            </div>
        @elseif($mid > 5 && $mid <= 10)
            <div class="severity">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div class="severity-text">
                    <h1>Medium Severity Level</h1>
                    <p>Mid-severity complaints are rising and approaching the danger zone. While the system is functional, systemic friction points are developing. Prompt attention will prevent this from escalating into a critical failure.</p>
                </div>
            </div>
        @else
            <div class="severity">
                <i class="fa-regular fa-face-smile"></i>
                <div class="severity-text">
                    <h1>Low Severity Level</h1>
                    <p>Complaint volumes are within safe, expected historical baselines. Incoming tickets represent isolated incidents rather than systemic system failures.</p>
                </div>
            </div>
        @endif
    <div class="table-container">
        <div class="table-filters">
            <form action="{{ url()->current() }}" method="GET" class="filter-form">
                <div class="filter-group">
                    <label for="severity">Severity:</label>
                    <select name="severity" id="severity" onchange="this.form.submit()">
                        <option value="">All Severities</option>
                        <option value="High" {{ request('severity') == 'High' ? 'selected' : '' }}>High</option>
                        <option value="Medium" {{ request('severity') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="Low" {{ request('severity') == 'Low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>

                @if(request('severity') || request('status'))
                    <a href="{{ url()->current() }}" class="clear-filter-btn">Clear Filters</a>
                @endif
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>HOMEOWNER</th>
                    <th>BLOCK/LOT</th>
                    <th>TITLE</th>
                    <th>CATEGORY</th>
                    <th>SEVERITY</th>
                    <th>STATUS</th>
                    <th>SUBMITTED ON</th>
                    <th>ACTIONS</th>
            </thead>
            <tbody>
                @forelse ($complaint as $comp)
                    <tr>
                        <td>{{ $comp->membership->homeowner->fullname()}}</td>
                        <td>B{{ $comp->membership->homeowner->lot->blockNumber}} L{{ $comp->membership->homeowner->lot->lotNumber}}</td>
                        <td>{{ $comp->title}}</td>
                        <td>{{ $comp->category}}</td>
                        <td>
                            <span class="severity-cell severity-{{ Str::slug($comp->severityLevel) }}">
                                {{ $comp->severityLevel }}
                            </span>
                        </td>
                        <td>
                            <span class="status-cell status-{{ Str::slug($comp->status) }}">
                                {{ $comp->status }}
                            </span>
                        </td>
                        <td>{{ $comp->submitDate->format('M d, Y') }}</td>
                        <td>
                            <button type="button" 
                                    class="update-btn btn" 
                                    onclick="document.getElementById('patch-form-{{ $comp->complaintID }}').submit();">
                                {{ $comp->status === 'Pending' ? 'Acknowledge' : 'Resolve' }}
                            </button>

                            <form id="patch-form-{{ $comp->complaintID }}" 
                                action="{{ route('admin.complaint.update', $comp->complaintID) }}" 
                                method="POST" 
                                style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No complaints</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-admin>