<x-admin>
    <x-view-header title="View User">
        <div class="header-buttons">
            <button type="button" class="btn-primary backBtn" data-url="{{ route('showUsers') }}">
                 Go Back
            </button>
        </div>
    </x-view-header>

    <div class="container-user">
        <p><strong>ID:</strong> {{ $user->userID }}</p>
        <p><strong>Email:</strong> {{ $user->loginEmail }}</p>
        <p><strong>Status:</strong> {{ $user->status }}</p>
        <p><strong>Role:</strong> {{ $user->role->roleName }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $user->updated_at }}</p>
    </div>
</x-admin>