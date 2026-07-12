<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('public/fav.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('public/fav.ico') }}">
    <title>HOA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Limelight&&family=Montserrat&family=Space+Grotesk&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="{{ asset('resources/js/admin/admin.js')}}?v={{ filemtime(resource_path('js/admin/admin.js')) }}"></script>
    @include('layouts.theme')
    <link rel="stylesheet" href="{{ asset('resources/css/admin/admin.css') }}?v={{ filemtime(resource_path('css/admin/admin.css')) }}">
    <link rel="stylesheet" href="{{ asset('resources/css/global.css') }}?v={{ filemtime(resource_path('css/global.css')) }}">
    <link rel="stylesheet" href="{{ asset('resources/css/admin/sidebar.css') }}?v={{ filemtime(resource_path('css/admin/sidebar.css')) }}">
</head>
<body>
    <div class="container">
        
        <!-- Sidebar -->
        <div class="sidebar-container">
            <table class="sidebar-wrapper">
                <thead>
                    <tr>
                        <td> <img src="{{ asset('public/storage/' . ($appConfig ? $appConfig->app_logo : 'default-logo.png')) }}" alt="image logo" class="sidebar-logo"></td>
                        <td> {{ $appConfig ? $appConfig->app_name : 'Default App Name' }} </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fa-solid fa-gauge"></i></td>
                        <td><a href="{{ route('admin.dashboard') }}">Dashboard</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-users"></i></td>
                        <td><a href="{{ route('showUsers') }}">Users Management</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-house"></i></td>
                        <td><a href="{{ route('admin.homeowner.index')}}">Homeowners</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-arrow-right-arrow-left"></i></td>
                        <td><a href="{{ route('admin.ownership.index')}}">Ownership Transfer</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-clipboard"></i></td>
                        <td><a href="{{ route('admin.complaint.index')}}">Complaints</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-wrench"></i></td>
                        <td><a href="{{ route('admin.maintenance.index')}}">Maintenance</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-droplet"></i></td>
                        <td><a href="{{ route('admin.water_reading.index')}}">Water Monitoring</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-credit-card"></i></td>
                        <td><a href="{{route('admin.billing.index')}}">Billing</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-bullhorn"></i></td>
                        <td><a href="#">Announcements</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-chart-bar"></i></td>
                        <td><a href="#">Reports</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-gear"></i></td>
                        <td><a href="{{ route('admin.app_config.index') }}">App Configuration</a></td>
                    </tr>

                </tbody>
            </table>

            <footer class="sidebar-footer">
                <img class="profile-img"
                    src="{{ auth()->user()->staff && auth()->user()->staff->profileImage
                            ? asset('storage/' . auth()->user()->staff->profileImage)
                            : asset('images/default-avatar.png') }}"
                    alt="Profile">
                <div class="profile-text">
                    <p class="role">{{auth()->user()->role->roleName}}</p>
                    <p class="name">{{auth()->user()->staff->firstName ?? 'William'}}</p>
                </div>
                <a href="#" class="logout-link" id="logoutBtn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>

                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </footer>
        </div>

        <!-- Main Content -->
        <div class="main-layout"> 
            {{ $slot }}
        </div>
            @if (
                session()->has('success') ||
                session()->has('error') ||
                session()->has('warning') ||
                session()->has('info') ||
                $errors->any()
            )
                @php
                    $type = 'success';

                    if (session()->has('error') || $errors->any()) {
                        $type = 'error';
                    } elseif (session()->has('warning')) {
                        $type = 'warning';
                    } elseif (session()->has('info')) {
                        $type = 'info';
                    }

                    $icons = [
                        'success' => 'fa-solid fa-circle-check',
                        'error'   => 'fa-solid fa-circle-exclamation',
                        'warning' => 'fa-solid fa-triangle-exclamation',
                        'info'    => 'fa-solid fa-circle-info',
                    ];
                @endphp

                <x-message class="message-{{ $type }}">
                    <div style="display: flex; align-items: flex-start; gap: .75rem;">
                        <i class="{{ $icons[$type] }}" style="font-size: 1.25rem;"></i>

                        <div>
                            @foreach (['success', 'error', 'warning', 'info'] as $messageType)
                                @if (session()->has($messageType))
                                    <strong>
                                        <p style="margin: 0;">
                                            {{ session($messageType) }}
                                        </p>
                                    </strong>
                                @endif
                            @endforeach

                            @if ($errors->any())
                                <strong>Please fix the following:</strong>
                                <ul style="margin: .25rem 0 0; padding-left: 1.25rem; font-size: .9rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </x-message>
            @endif
        </div>
</body>
