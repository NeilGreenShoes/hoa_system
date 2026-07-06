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
    <script src="{{ asset('public/js/auth/login.js')}}"></script>
    @include('layouts.theme')
    <link rel="stylesheet" href="{{ asset('public/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/login.css') }}">
</head>

<div class="container-form">
    <h1>WELCOME</h1><br>
    <form method="POST" action="{{ route('submitLogin') }}" id="loginForm">
        @csrf
        <div class="container-input">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Email..." required>

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Enter Password.." required>
                <i class="password-toggle fa-solid fa-eye fa-xl"></i>
            </div>
        </div>

        <div class="container-forgot">
            <h4>Forgot Password?</h4><span><a class="forgot-password">Click to Reset</a></span>
        </div>

        <div class="container-button">
            <button class="btn-primary submit-btn" type="button">Login</button>
            <button class="btn-secondary" type="btn-secondary button">Go Back</button>
            
        </div>
    </form>
</div>
<div class="container-img">
    <div class="image-filter"></div>
    <img class="image-login" src="{{ asset('public/images/placeholder.jpg')}}" alt="photo of hoa">
    <div class="image-tag">
        <h1>Simplicity is the ultimate sophistication</h1>
        <h3>— Leonardo da Vinci</h3>
    </div>
</div>
