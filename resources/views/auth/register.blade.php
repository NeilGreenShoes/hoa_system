<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('public/fav.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('public/fav.ico') }}">
    <title>HOA - Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="{{ asset('resources/js/auth/register.js')}}?v={{ filemtime(resource_path('js/auth/register.js')) }}"></script>
    @include('layouts.theme')
    <link rel="stylesheet" href="{{ asset('resources/css/global.css') }}?v={{ filemtime(resource_path('css/global.css')) }}">
    <link rel="stylesheet" href="{{ asset('resources/css/register.css') }}?v={{ filemtime(resource_path('css/register.css')) }}">
</head>
<body>

    <div class="contianer-homeowner">
        <div class="form-header">
            <div class="header-left">
                <h2>Create Account</h2>
                <p>Fill out the details below to join your Homeowners Association portal.</p>
                <p class="header-info"><i class="fa-solid fa-circle-info"></i> registration is only for homewoners.*</p>

            </div>
            <a href="/login" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Go to Login
            </a>
        </div>

        <form action="{{route('register.sendOtp')}}" method="POST" enctype="multipart/form-data" class="register-grid">
            @csrf
            @method('POST')
            
            <!-- Personal Information -->
            <div class="form-group">
                <label for="firstname" class="input-label">Firstname</label>
                <input type="text" name="firstname" class="input" required>
            </div>

            <div class="form-group">
                <label for="middlename" class="input-label">Middlename</label>
                <input type="text" name="middlename" class="input">
            </div>

            <div class="form-group">
                <label for="lastname" class="input-label">Lastname</label>
                <input type="text" name="lastname" class="input" required>
            </div>

            <div class="form-group">
                <label for="gender" class="input-label">Gender:</label>
                <select name="gender" class="select" required>
                    <option value="" selected disabled>Select a Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="contact" class="input-label">Contact Number</label>
                <input type="text" name="contact" class="input" inputmode="numeric" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="09123456789" required>
            </div>

            <div class="form-group">
                <label for="email" class="input-label">Email</label>
                <input type="email" name="email" class="input" required>
                <p class="email-info"><i class="fa-solid fa-circle-info"></i> the email you placed will be used as your login information.*</p>
            </div>

            <div class="form-group">
                <label for="dob" class="input-label">Date of Birth</label>
                <input type="date" name="dob" class="input" required>
            </div>

            <div class="form-group">
                <label for="marital" class="input-label">Marital Status</label>
                <select name="marital" class="select" required>
                    <option value="" selected disabled>Select status</option>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Seperated">Seperated</option>
                </select>
            </div>

            <div class="form-group">
                <label for="religion" class="input-label">Religion</label>
                <input type="text" name="religion" class="input" required>
            </div>

            <!-- Address Section Heading -->
            <div class="form-section-title span-full">
                <h3>Address Details</h3>
            </div>

            <div class="form-group">
                <label for="province" class="input-label">Province</label>
                <select name="province" id="province-select" class="select" required>
                    <option value="" selected disabled>Select Province</option>
                </select>
            </div>

            <div class="form-group">
                <label for="city" class="input-label">City / Municipality</label>
                <select name="city" id="city-select" class="select" required disabled>
                    <option value="" selected disabled>Select City</option>
                </select>
            </div>

            <div class="form-group">
                <label for="barangay" class="input-label">Barangay</label>
                <select name="barangay" id="barangay-select" class="select" required disabled>
                    <option value="" selected disabled>Select Barangay</option>
                </select>
            </div>

            <div class="form-group span-full">
                <label for="street" class="input-label">Street / House No.</label>
                <input type="text" name="street" class="input" placeholder="e.g. Blk 2 Lot 4, Sunshine St." required>
            </div>

            <!-- Profile Photo Row with Live Preview Area -->
            <div class="form-group span-full photo-upload-wrapper">
                <div class="preview-box">
                    <img id="profile-preview" src="https://ui-avatars.com/api/?name=HOA&background=f3f4f6&color=6b7280" alt="Preview">
                </div>
                <div class="upload-input-field">
                    <label for="profile" class="input-label">Profile Photo</label>
                    <input type="file" id="profile-input" name="profile" class="input" accept="image/*" required>
                </div>
            </div>

            <div class="form-group span-half">
                <label for="password" class="input-label">Password</label>
                <input type="password" name="password" class="input" required>
            </div>

            <div class="form-group span-half">
                <label for="confirm_password" class="input-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="input" required>
            </div>

            <div id="otp-step-container" class="form-group span-full" style="display: none;">
                <div style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 20px;">
                    <label for="otp_code" class="input-label" style="font-weight: 600; font-size: 16px; margin-bottom: 8px; color: #1e40af;">
                        Enter the 6-Digit Verification Code sent to your email
                    </label>
                    <input type="text" name="otp_code" id="otp_code" class="input" autocomplete="off" maxlength="6" pattern="[0-9]{6}" placeholder="000000" style="text-align: center; font-size: 24px; letter-spacing: 8px; width: 200px; margin: 0 auto; display: block;">
                    <p id="otp-error-message" style="color: #dc2626; font-size: 13px; margin: 8px 0 0 0; display: none;"></p>
                </div>
            </div>

            <!-- Action Area -->
            <div class="form-actions">
                
                <button type="submit" class="submit-btn">Register Account</button>
                <div class="login-redirect">
                    Already have an account? <a href="/login">Log In</a>
                </div>
            </div>

        </form>
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
</body>
</html>