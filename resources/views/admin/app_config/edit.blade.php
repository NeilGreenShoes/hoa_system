{{-- <scipt src="{{ asset('resources/js/admin/app_config/edit.js')}}"></script> --}}
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
                    <img src="{{ file_exists(storage_path('public/storage' . $appConfig->app_logo))
                    ? asset('storage/' . $appConfig->app_logo)
                    : asset('images/default-logo.png') }}" alt="App Logo" style="max-width: 100px; margin-top: 10px;">
                @endif
            </div>

            <div class="form-group">
                <label for="primary_color">Primary Color:</label>
                <div class="color-input-group">
                    <input
                        type="color"
                        id="primary_color"
                        name="primary_color"
                        value="{{ $appConfig->primary_color ?? '#4f46e5' }}">
                </div>
            </div>

            <div class="form-group">
                <label for="secondary_color">Secondary Color:</label>
                <div class="color-input-group">
                    <input
                        type="color"
                        id="secondary_color"
                        name="secondary_color"
                        value="{{ $appConfig->secondary_color ?? '#4f46e5' }}">
                </div>
            </div>
            <div class="form-group">
                <label for="tertiary_color">Tertiary Color:</label>
                <div class="color-input-group">
                    <input
                        type="color"
                        id="tertiary_color"
                        name="tertiary_color"
                        value="{{ $appConfig->tertiary_color ?? '#4f46e5' }}">

                </div>
            </div>

            <div class="form-group">
                <label for="view_header_color">View Header Color:</label>
                <input
                    type="color"
                    id="view_header_color"
                    name="view_header_color"
                    value="{{ $appConfig->view_header_color ?? '#ffffff' }}">
            </div>

            <div class="form-group">
                <label for="container_color">Container Color:</label>
                <input
                    type="color"
                    id="container_color"
                    name="container_color"
                    value="{{ $appConfig->container_color ?? '#ffffff' }}">
            </div>

            <div class="form-group">
                <label for="sidebar_color_primary">Sidebar Primary Color:</label>
                <div class="color-input-group">
                    <input
                        type="color"
                        id="sidebar_color_primary"
                        name="sidebar_color_primary"
                        value="{{ $appConfig->sidebar_color_primary ?? '#1f2937' }}">
                </div>
            </div>

            <div class="form-group">
                <label for="sidebar_color_secondary">Sidebar Secondary Color:</label>
                <div class="color-input-group">
                    <input
                        type="color"
                        id="sidebar_color_secondary"
                        name="sidebar_color_secondary"
                        value="{{ $appConfig->sidebar_color_secondary ?? '#1f2937' }}">
                </div>
            </div>

            <div class="form-group">
                <label for="background_color">Background Color:</label>
                <div class="color-input-group">
                    <input
                        type="color"
                        id="background_color"
                        name="background_color"
                        value="{{ $appConfig->background_color ?? '#1f2937' }}">
                </div>
            </div>

            <button type="submit" onclick="return confirm('Are you sure you want to update the app configuration?')">Update Configuration</button>
        </form>
</x-admin>