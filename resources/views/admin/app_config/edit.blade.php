<x-admin>
    <x-view-header title="App Configuration">
    </x-view-header>

    <div class="container-form">
        <form action="{{ route('admin.app_config.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="app_name">App Name:</label>
                <input type="text" id="app_name" name="app_name" value="{{ $appConfig->app_name ?? '' }}" required>
            </div>

            <div class="form-group">
                <label for="app_logo">App Logo:</label>
                <input type="file" id="app_logo" name="app_logo" accept="image/*">
                @if ($appConfig && $appConfig->app_logo)
                    <img src="{{ asset('storage/' . $appConfig->app_logo) }}" alt="App Logo" style="max-width: 100px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit" onclick="return confirm('Are you sure you want to update the app configuration?')">Update Configuration</button>
        </form>
</x-admin>