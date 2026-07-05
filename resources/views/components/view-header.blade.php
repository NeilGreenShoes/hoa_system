<nav class="view-header">
    <div>
        <h2><strong>{{ $title ?? 'N/A'}}</strong></h2>
        @include('partials.breadcrumb')
    </div>
    {{ $slot }}
</nav>