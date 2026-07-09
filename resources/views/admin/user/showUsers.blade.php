<script src="{{ asset('resources/js/admin/users/showUsers.js')}}?v={{ filemtime(resource_path('js/admin/users/showUsers.js')) }}"></script>
<link rel="stylesheet" href="{{ asset('resources/css/admin/users/showUsers.css') }}?v={{ filemtime(resource_path('css/admin/users/showUsers.css')) }}">
<x-admin>
    <x-view-header title="Users">
        <div class="header-buttons">
            {{-- <button class="btn">
                 Import
            </button>
            <button class="btn">
                 Export
            </button> --}}
            <button type="button" class="btn add-btn btn-primary createBtn" data-url="{{ route('createUser') }}">
                 Add User
            </button>
        </div>
    </x-view-header>
    <div class="container-view">
        <button class="btn btn-view" data-url=" {{route('showUsers')}}"> SHOW USERS</button>
        <button class="btn btn-view" data-url="{{route('user_activity')}}">VIEW ACTIVITY LOGS</button>
    </div>
    <div class="table-container container-user">
        
        <table class="table table-user">
            <thead class="table-header">
                <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>GENDER</th>
                    <th>CONTACT</th>
                    <th>STAUS</th>
                    <th>DATE CREATED</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody class="table-body">
               
                @foreach ($staff as $staffs)
                    <tr>
                        <td>{{ $staff->firstItem() + $loop->index }}</td>
                        <td class="text-start">{{ $staffs->fullName() }}</td>
                        <td class="text-start">{{ $staffs->email }}</td>
                        <td>{{ $staffs->user->role->roleName }}</td>
                        <td>{{ $staffs->gender }}</td>
                        <td>{{ $staffs->contactNumber }}</td>
                        <td>
                            <span class="badge badge-{{ Str::lower($staffs->user->status) }}">
                                <i class="circle fa-solid fa-circle fa-xs"></i> {{ $staffs->user->status }}
                            </span>
                        </td>
                        <td>{{ $staffs->user->created_at->format('M d, Y') }}</td>
                        
                        <td class="container-button">
                            <button class="action-btn btn-primary btn-edit" data-url="{{ route('editUser', ['id' => $staffs->staffID]) }}"><i class="fa-solid fa-pencil"></i></button>
                            <button class="action-btn btn-secondary btn-view" data-url="{{ route('viewUser', ['id' => $staffs->staffID]) }}"><i class="fa-solid fa-eye"></i></button>
                            <form action="{{ route('archiveUser', ['id' => $staffs->staffID]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to archive this user?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-tertiary btn-archive "><i class="fa-solid fa-box-archive"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    {{ $staff->links('vendor.pagination.bootstrap-5') }}

    
</x-admin> 