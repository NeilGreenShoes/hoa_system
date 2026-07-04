@vite('resources/js/admin/users/user.js')
<x-admin>
    <x-view-header title="Create User">
        <div class="header-buttons">
            <button type="button" class="btn-primary backBtn" data-url="{{ route('showUsers') }}">
                 Go Back
            </button>
        </div>
    </x-view-header>
    <div class="container-user">
        <form action="{{ route('storeUser') }}" method="POST">
            @csrf
            <label for="loginEmail">Email:</label>
            <input type="email" name="loginEmail" id="loginEmail" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
            <br>
            <label for="roleID">Role:</label>
            <select name="roleID" id="roleID" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->roleID }}">{{ $role->roleName }}</option>
                @endforeach
            </select>
            <br>
            <button type="submit">Create User</button>
        </form>
    </div>
</x-admin>