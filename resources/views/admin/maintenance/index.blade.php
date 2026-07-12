<link rel="stylesheet" href="{{ asset('resources/css/admin/maintenance/index.css')}}?v={{ filemtime(resource_path('css/admin/maintenance/index.css')) }}">
<x-admin>
    <x-view-header title="Complaint Management">

    </x-view-header>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>HOMEOWNER</th>
                    <th>BLOCK/LOT</th>
                    <th>TITLE</th>
                    <th>CATEGORY</th>
                    <th>STATUS</th>
                    <th>DATE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($maintenance as $maint)
                    <tr>
                        <td>{{$maint->membership->homeowner->fullname()}}</td>
                        <td>B{{$maint->membership->homeowner->lot->blockNumber}} L{{$maint->membership->homeowner->lot->lotNumber}}</td>
                        <td>{{$maint->title}}</td>
                        <td>{{$maint->category}}</td>
                        <td>
                            <span class="status-cell status-{{Str::slug($maint->status)}}">
                                {{$maint->status}}
                            </span>
                        </td>
                        <td>{{$maint->requestDate->format('M d, Y')}}</td>
                        <td>
                            <button type="button" 
                                    class="update-btn btn" 
                                    onclick="document.getElementById('patch-form-{{ $maint->maintenanceID }}').submit();">
                                {{ $maint->status === 'Pending' ? 'Acknowledge' : 'Completed' }}
                            </button>

                            <form id="patch-form-{{ $maint->maintenanceID }}" 
                                action="{{ route('admin.maintenance.update', $maint->maintenanceID) }}" 
                                method="POST" 
                                style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No maintenance requests</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin>