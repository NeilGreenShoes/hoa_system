@vite('resources/js/admin/users/showUsers.js')
<x-admin>
    <x-view-header title="Users">
        <div class="header-buttons">
            <button class="btn">
                 Import
            </button>
            <button class="btn">
                 Export
            </button>
            <button type="button" class="add-btn btn-primary createBtn" data-url="{{ route('createUser') }}">
                 Add User
            </button>
        </div>
    </x-view-header>
    <div class="container-user">
        <table class="table-user">
            <thead class="table-header">
                <tr>
                    <th>#</th>
                    <th><i class="fa-regular fa-envelope fa-xl"></i>Email</th>
                    <th><i class="fa-solid fa-wave-square fa-xl"></i>Status</th>
                    <th><i class="fa-regular fa-calendar fa-xl"></i>Created At</th>
                    <th><i class="fa-regular fa-calendar fa-xl"></i> Updated At</th>
                    <th><i class="fa-solid fa-bars fa-xl"></i>Actions</th>
                </tr>
            </thead>
            <tbody class="table-body">
               
                @foreach ($user as $users)
                    <tr>
                        <td>{{ ($user->currentPage() - 1) * $user->perPage() + $loop->index + 1 }}</td>
                        <td class="text-start">{{ $users->loginEmail }}</td>
                        <td>
                            <span class="badge badge-{{ Str::lower($users->status) }}">
                                <i class="circle fa-solid fa-circle fa-xs"></i> {{ $users->status }}
                            </span>
                        </td>
                        <td>{{ $users->created_at->format('M d, Y') }}</td>
                        <td>{{ $users->updated_at->format('M d, Y') }}</td>
                        <td>
                            <button class="action-btn btn-primary btn-edit" data-url="{{ route('editUser', ['id' => $users->userID]) }}">Edit</button>
                            <button class="action-btn btn-secondary btn-view" data-url="{{ route('viewUser', ['id' => $users->userID]) }}">View</button>
                            <form action="{{ route('archiveUser', ['id' => $users->userID]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to archive this user?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-archive action-btn">Archive</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $user->links('vendor.pagination.bootstrap-5') }}
    </div>
</x-admin> 