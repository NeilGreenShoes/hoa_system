<link rel="stylesheet" href="{{ asset('resources/css/admin/homeowner/show.css')}}?v={{ filemtime(resource_path('css/admin/homeowner/show.css')) }}">
<x-admin>
    <x-view-header title="View Homeowner">

    </x-view-header>

    <div class="view-user-container">

        <div class="view-card">

            <div class="card-title">
                Homeowner Information
            </div>

            <div class="staff-profile">

                <div class="staff-image">
                    <img
                        src="{{ $homeowner->profileImage
                            ? asset('storage/' . $homeowner->profileImage)
                            : asset('images/default-profile.png') }}"
                        alt="Homeowner Profile">
                </div>

                <div class="info-grid">

                    <div class="info-item">
                        <span>Homeowner ID</span>
                        <p>{{ $homeowner->homeownerID }}</p>
                    </div>

                    <div class="info-item">
                        <span>Full Name</span>
                        <p>{{ $homeowner->fullname() }}</p>
                    </div>

                    <div class="info-item">
                        <span>First Name</span>
                        <p>{{ $homeowner->firstName }}</p>
                    </div>

                    <div class="info-item">
                        <span>Middle Name</span>
                        <p>{{ $homeowner->middleName ?: '-' }}</p>
                    </div>

                    <div class="info-item">
                        <span>Last Name</span>
                        <p>{{ $homeowner->lastName }}</p>
                    </div>

                    <div class="info-item">
                        <span>Date of Birth</span>
                        <p>{{ \Carbon\Carbon::parse($homeowner->dateOfBirth)->format('F d, Y') }}</p>
                    </div>

                    <div class="info-item">
                        <span>Gender</span>
                        <p>{{ ucfirst($homeowner->gender) }}</p>
                    </div>

                    <div class="info-item">
                        <span>Religion</span>
                        <p>{{ $homeowner->religion ?: '-' }}</p>
                    </div>

                    <div class="info-item">
                        <span>Marital Status</span>
                        <p>{{ $homeowner->maritalStatus }}</p>
                    </div>

                    <div class="info-item">
                        <span>Contact Number</span>
                        <p>{{ $homeowner->contactNumber }}</p>
                    </div>

                    <div class="info-item">
                        <span>Email</span>
                        <p>{{ $homeowner->email }}</p>
                    </div>

                    <div class="info-item">
                        <span>User Account</span>
                        <p>{{ $homeowner->user?->loginEmail ?? 'Not Linked' }}</p>
                    </div>

                    <div class="info-item">
                        <span>Address ID</span>
                        <p>{{ $homeowner->addressID }}</p>
                    </div>

                    @if($homeowner->address)
                    <div class="info-item" style="grid-column:1/-1;">
                        <span>Address</span>
                        <p>
                            {{ $homeowner->address->streetAddress ?? '' }},
                            {{ $homeowner->address->barangay ?? '' }},
                            {{ $homeowner->address->city ?? '' }},
                            {{ $homeowner->address->province ?? '' }}
                        </p>
                    </div>
                    @endif

                    @if($homeowner->created_at)
                    <div class="info-item">
                        <span>Created At</span>
                        <p>{{ \Carbon\Carbon::parse($homeowner->created_at)->format('F d, Y h:i A') }}</p>
                    </div>
                    @endif

                    @if($homeowner->updated_at)
                    <div class="info-item">
                        <span>Updated At</span>
                        <p>{{ \Carbon\Carbon::parse($homeowner->updated_at)->format('F d, Y h:i A') }}</p>
                    </div>
                    @endif

                </div>

            </div>

        </div>

    </div>
</x-admin>