<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favico.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favico.ico') }}">
    <title>HOA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Limelight&&family=Montserrat&family=Space+Grotesk&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="{{ asset('js/admin/admin.js')}}"></script>
    @include('layouts.theme')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
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
                        <td><a href="#">Homeowners</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-arrow-right-arrow-left"></i></td>
                        <td><a href="#">Ownership Transfer</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-clipboard"></i></td>
                        <td><a href="#">Complaints</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-wrench"></i></td>
                        <td><a href="#">Maintenance</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-droplet"></i></td>
                        <td><a href="#">Water Monitoring</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-credit-card"></i></td>
                        <td><a href="#">Billing</a></td>
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

            <div class="sidebar-footer">
                <a href="{{ route('logout') }}" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-layout"> 
            {{ $slot }}
        </div>
    </div>
</body>
