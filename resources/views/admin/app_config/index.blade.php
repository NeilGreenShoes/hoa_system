<x-admin>
    <x-view-header title="App Configuration">
    </x-view-header>

    <div class="container-app-config">
        <table class="table-app-config">
            <thead>
                <tr>
                    <th>App Name</th>
                    <th>App Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($appConfig)
                    <tr>
                        <td>{{ $appConfig->app_name }}</td>
                        <td><img src="{{ asset('storage/' . $appConfig->app_logo) }}" alt="App Logo" width="100"></td>
                        <td>
                            <a href="{{ route('admin.app_config.edit') }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="3">No app configuration found.</td>
                    </tr>
                @endif
            </tbody>
        
</x-admin>