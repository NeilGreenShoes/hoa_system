<script src={{ asset('resources/js/admin/users/showUsers.js')}}></script>
<x-admin>
    <x-view-header title="Activity Logs">
    </x-view-header>
    <div class="container-view">
        <button class="btn btn-view" data-url=" {{route('showUsers')}}"> SHOW USERS</button>
        <button class="btn btn-view" data-url="{{route('user_activity')}}">VIEW ACTIVITY LOGS</button>
    </div>
    <div class="table-container container-logs">
        <div class="card shadow-sm">
            
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>User ID</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activity_logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->userID }}</td>
                                <td>{{ $log->created_at->format('M d, Y h:i A') }}</td>
                                <td>{{ $log->updated_at->format('M d, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No activity logs found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin>