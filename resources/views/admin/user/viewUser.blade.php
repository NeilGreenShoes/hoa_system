<link rel="stylesheet" href="{{ asset('resources/css/admin/users/viewUser.css') }}?v={{ filemtime(resource_path('css/admin/users/viewUser.css')) }}">
<x-admin>
    <x-view-header title="View User">
        <div class="header-buttons">
            <button type="button"
                class="btn-primary backBtn"
                data-url="{{ route('showUsers') }}">
                Go Back
            </button>
        </div>
    </x-view-header>

    <div class="view-user-container">
        <!-- Staff Information -->
        <div class="view-card">
            <div class="card-title">Staff Information</div>
            <div class="staff-profile">
                <div class="staff-image">
                    <img src="{{ $staff->profileImage ? asset('storage/'.$staff->profileImage) : asset('images/default-profile.png') }}" alt="Staff Profile">
                </div>
                <div class="info-grid">
                    <div class="info-item"><span>Staff ID</span><p>{{ $staff->staffID }}</p></div>
                    <div class="info-item"><span>Full Name</span><p>{{ $staff->name()}}</p></div>
                    <div class="info-item"><span>Date of Birth</span><p>{{ $staff->dateOfBirth }}</p></div>
                    <div class="info-item"><span>Gender</span><p>{{ $staff->gender }}</p></div>

                    <div class="info-item">
                        <span>Marital Status</span>
                        <p>{{ $staff->maritalStatus }}</p>
                    </div>

                    <div class="info-item">
                        <span>Contact Number</span>
                        <p>{{ $staff->contactNumber }}</p>
                    </div>

                    <div class="info-item">
                        <span>Email</span>
                        <p>{{ $staff->email }}</p>
                    </div>

                    <div class="info-item">
                        <span>Address ID</span>
                        <p>{{ $staff->addressID }}</p>
                    </div>

                    @if($staff->address)
                        <div class="info-item" style="grid-column:1/-1;">
                            <span>Address</span>
                            <p>
                                {{ $staff->address->streetAddress ?? '' }}
                                {{ $staff->address->barangay ?? '' }}
                                {{ $staff->address->city ?? '' }}
                                {{ $staff->address->province ?? '' }}
                            </p>
                        </div>
                    @endif

                    <div class="info-item">
                        <span>Created At</span>
                        <p>{{ $staff->created_at->format('F d, Y h:i A') }}</p>
                    </div>

                    <div class="info-item">
                        <span>Updated At</span>
                        <p>{{ $staff->updated_at->format('F d, Y h:i A') }}</p>
                    </div>

                </div>

            </div>

        </div>

        <!-- User Account -->
        <div class="view-card">
            <div class="card-title">
                User Account
            </div>

            <div class="info-grid">

                <div class="info-item">
                    <span>User ID</span>
                    <p>{{ $staff->user->userID }}</p>
                </div>

                <div class="info-item">
                    <span>Login Email</span>
                    <p>{{ $staff->user->loginEmail }}</p>
                </div>

                <div class="info-item">
                    <span>Status</span>
                    <p>
                        <span class="status {{ strtolower($staff->user->status) }}">
                            {{ ucfirst($staff->user->status) }}
                        </span>
                    </p>
                </div>

                <div class="info-item">
                    <span>Role</span>
                    <p>{{ $staff->user->role->roleName }}</p>
                </div>

                <div class="info-item">
                    <span>Created At</span>
                    <p>{{ $staff->user->created_at->format('F d, Y h:i A') }}</p>
                </div>

                <div class="info-item">
                    <span>Updated At</span>
                    <p>{{ $staff->user->updated_at->format('F d, Y h:i A') }}</p>
                </div>

            </div>
        </div>
    </div>

    @if(session('message') || $errors->any())
        <x-message class="{{ $errors->any() ? 'message-error' : '' }}">
            @if(session('message'))
                <strong>{{ session('message') }}</strong>
            @endif

            @if($errors->any())
                <strong>Please fix the following:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </x-message>
    @endif

</x-admin>