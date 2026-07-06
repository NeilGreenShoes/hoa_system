<style>
:root {
    --primary-color: {{ $config->primary_color ?? '#4f46e5' }};
    --secondary-color: {{ $config->secondary_color ?? '#4f46e5' }};
    --sidebar-color-primary: {{ $config->sidebar_color_primary ?? '#1f2937' }};
    --sidebar-color-secondary: {{ $config->sidebar_color_secondary ?? '#1f2937' }};
    --background-color: {{ $config->background_color ?? '#ffffff'}};
}
</style>