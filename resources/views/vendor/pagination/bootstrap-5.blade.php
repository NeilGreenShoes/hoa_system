@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between align-items-center flex-wrap gap-3" style="margin-top: 1.5rem;">
        <div class="small text-muted font-family-modern">
            {!! __('Showing') !!}
            <span class="fw-semibold text-dark">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="fw-semibold text-dark">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="fw-semibold text-dark">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </div>

        <div>
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif

<style>
    .font-family-modern {
        font-family: system-ui, -apple-system, sans-serif;
        font-size: 0.875rem;
    }

    .pagination {
        display: inline-flex !important;
        flex-direction: row !important;
        align-items: center;
        gap: 0.375rem;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
        background-color: transparent !important;
    }

    .pagination .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.25rem;
        height: 2.25rem;
        padding: 0 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        border-radius: 0.375rem !important;
        transition: all 0.2s ease-in-out;
        font-family: system-ui, -apple-system, sans-serif;
        border: 1px solid #e2e8f0;
        color: #4b5563; 
        background-color: #f3f4f6; 
    }

    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        min-width: auto;
        padding: 0 1rem;
    }

    .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
        color: #1f2937;
        background-color: #e5e7eb;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    .pagination .page-item.active .page-link {
        color: #ffffff !important;
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }

    .pagination .page-item.disabled .page-link {
        color: #9ca3af !important;
        background-color: #f9fafb !important;
        border-color: #e2e8f0 !important;
        cursor: not-allowed;
    }
</style>
