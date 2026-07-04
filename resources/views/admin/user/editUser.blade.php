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
        <h1>User Information</h1>
        <hr />
        <form action="{{ route('updateUser', ['id' => $user->userID]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group form-email">
                <label for="loginEmail">Email:</label>
                <input type="email" name="loginEmail" id="loginEmail" value="{{ $user->loginEmail }}" required>
            </div>

            <div class="form-group form-password">
                <label for="password">Password:</label> <i class="fa-solid fa-eye"></i>
                <input type="password" name="password" id="password" placeholder="Enter new password if you want to change it">
            </div>

            <div class="form-group form-password-confirm">
                <label for="password_confirmation">Confirm Password:</label> <i class="fa-solid fa-eye"></i>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password">
            </div>

            <div class="form-group form-status">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="Active" {{ $user->status === 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $user->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="form-group form-role">
                <label for="roleID">Role:</label>
                <select name="roleID" id="roleID" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->roleID }}" {{ $user->roleID === $role->roleID ? 'selected' : '' }}>{{ $role->roleName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-button">
                <button class="submit-btn btn-primary" type="submit">Update User</button>
                <button class="cancel-btn btn-secondary" type="reset">Cancel</button>
            </div>
        </form>
</x-admin>