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