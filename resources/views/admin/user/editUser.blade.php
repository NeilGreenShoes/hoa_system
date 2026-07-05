@vite('resources/js/admin/users/user.js')
@vite('resources/js/admin/users/editUser.js')
<x-admin>
    <x-view-header title="Edit User">
        <div class="header-buttons">
            <button type="button" class="btn-primary backBtn" data-url="{{ route('showUsers') }}">
                 Go Back
            </button>   
        </div>
    </x-view-header>
    <div class="container-user">
        <strong>EDIT CURRENT STAFF AND USER ACCOUNT</strong>
        <hr />
        <form action="{{ route('updateUser', $staff->staffID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            PERSONAL INFORMATION
            
            <div class="form-group form-name">
                <div>
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" placeholder="Enter last name" value="{{ old('lastName', $staff->lastName)}}" required>
                </div>

                <div>
                    <label for="firstName">First Name: </label>
                    <input type="text" name="firstName" id="firstName" placeholder="Enter first name" value="{{ old('firstName', $staff->firstName)}}" required>
                </div>

                <div>
                    <label for="middleName">Middle Name:</label>
                    <input type="text" name="middleName" id="middleName" placeholder="Enter middle name" value="{{ old('middleName', $staff->middleName)}}" required>
                </div>

                <div class="form-group form-dob">
                    <label for="dateOfBirth">Date of Birth:</label>
                    <input type="date" name="dateOfBirth" id="dateOfBirth" value="{{ old('dateOfBirth', $staff->dateOfBirth)}}" required>
                </div>

                <div class="form-group form-gender">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" required>
                        <option value="" disabled {{ old('gender', $staff->gender) ? '' : 'selected' }}>Select Gender</option>
                        <option value="Male" {{ old('gender', $staff->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $staff->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="form-group form-marital-status">
                    <label for="maritalStatus">Marital Status:</label>
                    <select name="maritalStatus" id="maritalStatus" required>
                        <option value="" disabled {{ old('maritalStatus', $staff->maritalStatus) ? '' : 'selected' }}>Select Marital Status</option>
                        <option value="Single" {{ old('maritalStatus', $staff->maritalStatus) == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('maritalStatus', $staff->maritalStatus) == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Divorced" {{ old('maritalStatus', $staff->maritalStatus) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="Widowed" {{ old('maritalStatus', $staff->maritalStatus) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>
            </div>
            
            CONTACT INFORMATION
            <br />
            <div class="form-group form-contact">
                <label for="contactNumber">Contact Number:</label>
                <input type="text" name="contactNumber" id="contactNumber" value="{{ old('conctactNumber', $staff->contactNumber)}}"required>
            </div>   

            PERSONAL ADDRESS 
            <br>
            <div class="form-group form-address">
                <div>
                    <label for="street">Street / Unit Number:</label>
                    <input type="text" name="street" id="street" value="{{ old('street', $staff->address->street) }}" required>
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

                <input
                    type="hidden"
                    id="oldProvince"
                    value="{{ old('province', optional($staff->address)->province) }}">

                <input
                    type="hidden"
                    id="oldCity"
                    value="{{ old('city', optional($staff->address)->city) }}">

                <input
                    type="hidden"
                    id="oldBarangay"
                    value="{{ old('barangay', optional($staff->address)->barangay) }}">
            </div>

            
            USER INFORMATION
            <div class="form-group form-span">
                    
                <div class="form-group form-email">
                    <label for="loginEmail">Email:</label>
                    <input type="email" name="loginEmail" id="loginEmail" value=" {{ old('loginEmail', $staff->user->loginEmail)}}" required>
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
                    <input type="text" name="password" id="password">
                </div>
                <div class="form-group form-confirm-password">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="text" name="confirmPassword" id="confirmPassword" >
                </div>
                <div class="form-group form-status">
                    <label for="status">Status:</label>
                    <select name="status" id="status" required>
                        <option value="" disabled {{ old('status', $staff->user->status) == null ? 'selected' : '' }}>
                            Select Status
                        </option>
                        <option value="Active" {{ old('status', $staff->user->status) == 'Active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="Inactive" {{ old('status', $staff->user->status) == 'Inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="form-group form-role">
                    <label for="roleID">Role:</label>
                    <select name="roleID" id="roleID" required>
                        <option value="" disabled {{ old('roleID', $staff->user->roleID) == null ? 'selected' : '' }}>
                            Select Role
                        </option>

                        @foreach ($roles as $role)
                            <option
                                value="{{ $role->roleID }}"
                                {{ old('roleID', $staff->user->roleID) == $role->roleID ? 'selected' : '' }}>
                                {{ $role->roleName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>
                
            </div>
            <br>
            <div class="form-button">
                <button class="submit-btn btn-primary" type="submit"><i class="fa-solid fa-check"></i>Update User</button>
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