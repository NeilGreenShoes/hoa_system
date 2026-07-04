<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favico.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favico.ico') }}">
    <title>HOA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Limelight&family=Space+Grotesk&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite('resources/js/admin/admin.js')
</head>
<body>
    <div class="container">
        
        <!-- Sidebar -->
        <div class="sidebar-container">
            <table class="sidebar-wrapper">
                <thead>
                    <tr>
                        <td> <img src="{{ asset('static/images/logo.png') }}" alt="image logo" class="sidebar-logo"></td>
                        <td> {{ 'CONFIG.APP NAME'}} </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fa-solid fa-gauge"></i></td>
                        <td><a href="{{ route('admin.dashboard') }}">Dashboard</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-users"></i></td>
                        <td><a href="{{ route('showUsers') }}">Users</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-calendar-days"></i></td>
                        {{-- <td><a href="{{ route('manager.user-list')}}">Users</a></td> --}}
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-bed"></i></td>
                        <td><a href="#">Rooms</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-bed"></i></td>
                        <td><a href="#">Amenities</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-bed"></i></td>
                        <td><a href="#">Food</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-bed"></i></td>
                        <td><a href="#">Facilities</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-bed"></i></td>
                        <td><a href="#">Rooms</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-bed"></i></td>
                        <td><a href="#">Rooms</a></td>
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
