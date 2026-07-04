<nav class="view-header">
    <div>
        {{ $title ?? 'N/A'}}
        @include('partials.breadcrumb')
    </div>
    {{ $slot }}
</nav>