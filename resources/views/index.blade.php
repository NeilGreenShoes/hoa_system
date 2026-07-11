<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('public/fav.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('public/fav.ico') }}">
    <title>HOA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Inter&family=Limelight&&family=Montserrat&family=Space+Grotesk&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @include('layouts.theme')
    <link rel="stylesheet" href="{{ asset('resources/css/index.css')}}?v={{ filemtime(resource_path('css/index.css')) }}">
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <img class="navbar-img" src="{{asset('public/images/transparent_logo.png')}}">
                <h2>VALEEN VISTA</h2>
            </div>
            <div class="nav-items">
                <a class="active">HOME</a>
                <a>SERVICES</a>
                <a>ABOUT US</a>
                <a>CONTACTS</a>
            </div>
            <div class="nav-login">
                <div class="register">
                    <a href="{{ route('register')}}">REGISTER</a>
                </div>
                <div class="login">
                    <a href="{{ route('login')}}">LOGIN</a>
                </div>
            </div>
        </nav>
        <div class="hero-section">
            <img class="hero-img" src="{{asset('public/images/landingpage_image2.jpg')}}">
            <div class="hero-img-filter"></div>
            <div class="hero-text">
                <h1 class="main-text"> Connecting Our Community, Simplifying Life at Home. </h1>
                <h3>Your all-in-one neighborhood portal.</h3>
                <p>Manage your home, connect with neighbors, and stay up to date with HOA announcements—all from one convenient dashboard.</p>
            </div>
        </div>
    </div>
</body>
</html>