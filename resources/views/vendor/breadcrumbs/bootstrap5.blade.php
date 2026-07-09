@unless ($breadcrumbs->isEmpty())
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless

<style>
    .breadcrumb {
        list-style: none;
        display: flex;
        gap: 4px;
        padding: 0;
    }

    .breadcrumb-item a {
        color: inherit;
        text-decoration: none;
        transition: all .2s ease;
        cursor: pointer;
    }

    .breadcrumb-item:hover {
        font-weight: bold;
        color: var(--primary-color);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: "/";
        margin-right: 8px;
        color: #999;
    }
</style>