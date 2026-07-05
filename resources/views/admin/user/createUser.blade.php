<script src="{{ asset('js/admin/users/user.js') }}"></script>
<script src="{{ asset('js/admin/users/createUser.js') }}"></script>
<x-admin>
    <x-view-header title="Create User">
        <div class="header-buttons">
            <button type="button" class="btn-primary backBtn" data-url="{{ route('showUsers') }}">
                 Go Back
            </button>
        </div>
    </x-view-header>
    <div class="container-user">
        <strong>CREATE NEW STAFF AND USER ACCOUNT</strong>
        <hr />
        <form action="{{ route('storeUser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            PERSONAL INFORMATION
            
            <div class="form-group form-name">
                <div>
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" placeholder="Enter last name" required>
                </div>

                <div>
                    <label for="firstName">First Name: </label>
                    <input type="text" name="firstName" id="firstName" placeholder="Enter first name" required>
                </div>

                <div>
                    <label for="middleName">Middle Name:</label>
                    <input type="text" name="middleName" id="middleName" placeholder="Enter middle name" required>
                </div>

                <div class="form-group form-dob">
                    <label for="dateOfBirth">Date of Birth:</label>
                    <input type="date" name="dateOfBirth" id="dateOfBirth" required>
                </div>

                <div class="form-group form-gender">
                    <label for="gender">Gender:</label> 
                    <select name="gender" id="gender" required>
                        <option value="" selected disabled> Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group form-marital-status">
                    <label for="maritalStatus">Marital Status:</label>
                    <select name="maritalStatus" id="maritalStatus" required>
                        <option value="" selected disabled> Select Marital Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
            </div>
            
            CONTACT INFORMATION
            <br />
            <div class="form-group form-contact">
                <label for="contactNumber">Contact Number:</label>
                <input type="text" name="contactNumber" id="contactNumber" required>
            </div>   

            PERSONAL ADDRESS 
            <br>
            <div class="form-group form-address">
                <div> 
                    <label for="street">Street / Unit Number:</label>
                    <input type="text" name="street" id="street" value="{{ old('street') }}" required>
                </div>

                <div> 
                    <label for="province">Province:</label>
                    <select name="province" id="province" required>
                        <option value="">Loading provinces...</option>
                    </select>
                </div>

                <div>
                    <label for="city">City / Municipality:</label>
                    <select name="city" id="city" required disabled>
                        <option value="">Select province first</option>
                    </select>
                </div>

                <div>
                    <label for="barangay">Barangay:</label>
                    <select name="barangay" id="barangay" required disabled>
                        <option value="">Select city first</option>
                    </select>
                </div>  
            </div>

            
            USER INFORMATION
            <div class="form-group form-span">
                    
                <div class="form-group form-email">
                    <label for="loginEmail">Email:</label>
                    <input type="email" name="loginEmail" id="loginEmail" required>
                </div>
                <div class="form-group form-profile">
                    <label for="profile" class="file-drop-area" id="drop-area">
                        <!-- Preview Container -->
                        <div id="preview-container" class="hidden">
                            <img id="image-preview" src="" alt="Profile Preview">
                        </div>
                        
                        <!-- Default Upload View -->
                        <div id="upload-prompt">
                            <span class="upload-icon">📁</span>
                            <span class="upload-text">Click or drag a profile picture here</span>
                        </div>
                        
                        <input type="file" name="profile" id="profile" accept="image/*">
                    </label>
                </div>
            </div>

            <div class="fomr-group form-user-info">

                <div class="form-group form-password">
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" required>
                </div>
                <div class="form-group form-confirm-password">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="text" name="confirmPassword" id="confirmPassword" required>
                </div>
                <div class="form-group form-status">    
                    <label for="status">Status:</label>
                    <select name="status" id="status" required>
                        <option value="" selected disabled> Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group form-role">
                    <label for="roleID">Role:</label>
                    <select name="roleID" id="roleID" required>
                        <option value="" selected disabled> Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->roleID }}">{{ $role->roleName }}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
            <br>
            <div class="form-button">
                <button class="submit-btn btn-primary" type="submit"><i class="fa-solid fa-check"></i>Create User</button>
                <button class="cancel-btn btn-secondary" type="reset">Clear</button>
            </div>
            <br>
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
</x-admin>