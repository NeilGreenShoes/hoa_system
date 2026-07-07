<script src="{{ asset('resources/js/admin/users/showUsers.js')}}"></script>
<link rel="stylesheet" href="{{ asset('resources/css/admin/users/showUsers.css') }}">
<x-admin>
    <x-view-header title="Users">
        <div class="header-buttons">
            {{-- <button class="btn">
                 Import
            </button>
            <button class="btn">
                 Export
            </button> --}}
            <button type="button" class="add-btn btn-primary createBtn" data-url="{{ route('createUser') }}">
                 Add User
            </button>
        </div>
    </x-view-header>
    <div class="container-user">
        <div class="container-view">
            <button class="btn btn-view" data-url=" {{route('showUsers')}}"> SHOW USERS</button>
            <button class="btn btn-view" data-url="{{route('user_activity')}}">VIEW ACTIVITY LOGS</button>
        </div>
        <table class="table-user">
            <thead class="table-header">
                <tr>
                    <th>#</th>
                    <th><i class="fa-solid fa-user fa-xl"></i> NAME</th>
                    <th><i class="fa-regular fa-envelope fa-xl"></i>EMAIL</th>
                    <th><i class="fa-solid fa-user-shield fa-xl"></i>ROLE</th>
                    <th><i class="fa-solid fa-venus-mars fa-xl"></i>GENDER</th>
                    <th><i class="fa-solid fa-phone fa-xl"></i>CONTACT</th>
                    <th><i class="fa-solid fa-wave-square fa-xl"></i>STAUS</th>
                    <th><i class="fa-regular fa-calendar fa-xl"></i>DATE CREATED</th>
                    <th><i class="fa-solid fa-bars fa-xl"></i>ACTIONS</th>
                </tr>
            </thead>
            <tbody class="table-body">
               
                @foreach ($staff as $staffs)
                    <tr>
                        <td>{{ ($staff->currentPage() - 1) * $staff->perPage() + $loop->index + 1 }}</td>
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
                                <button type="submit" class="btn btn-archive "><i class="fa-solid fa-box-archive"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    {{ $staff->links('vendor.pagination.bootstrap-5') }}

    @if (session('message') || $errors->any())
        <x-message class="{{ $errors->any() ? 'message-error' : '' }}">
            @if (session('message'))
                <strong><p style="margin: 0;">{{ session('message') }}</p></strong>
            @endif

            @if ($errors->any())
                <strong>Please fix the following:</strong>
                <ul style="margin: 0.25rem 0 0 0; padding-left: 1.25rem; font-size: 0.9rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </x-message>
    @endif
</x-admin> 