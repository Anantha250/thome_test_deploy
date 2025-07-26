<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .pagination a {
        background: white;
        border: 1px solid #d1d5db;
        color: #374151;
        text-decoration: none;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.875rem;
        transition: all 0.2s;
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pagination a:hover:not(:disabled) {
        background: #f3f4f6;
        border-color: #9ca3af;
    }

    .pagination a:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination a.active {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }

    .pagination a.prev,
    .pagination a.next {
        font-weight: 500;
    }

    .pagination-info {
        text-align: center;
        margin-bottom: 1rem;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .items-per-page {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .items-per-page select {
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: white;
        font-size: 0.875rem;
    }
</style>



@if ($paginator->hasPages())
    <div class="ui pagination menu" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="icon item disabled" aria-disabled="true" aria-label="← Previous">← Previous</a>
        @else
            <a class="icon item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="← Previous">←
                Previous</a>
        @endif

        @foreach ($elements as $element)
            @if (is_array($element))
                @php
                    $totalPages = $paginator->lastPage();
                    $maxVisablePages = 5;
                    $startPage = max(1, $paginator->currentPage() - floor($maxVisablePages / 2));
                    $endPage = min($totalPages, $startPage + $maxVisablePages - 1);

                    if ($endPage - $startPage < $maxVisablePages - 1) {
                        $startPage = max(1, $endPage - $maxVisablePages + 1);
                    }
                @endphp

                @if ($startPage > 1)
                    <a class="item" href="{{ $paginator->url(1) }}">1</a>
                    @if ($startPage > 2)
                        <span style="padding: 0 0.5rem;">...</span>
                    @endif
                @endif

                @for ($i = $startPage; $i <= $endPage; $i++)
                    @if ($i == $paginator->currentPage())
                        <a class="item active" href="{{ $paginator->url($i) }}"
                            aria-current="page">{{ $i }}</a>
                    @else
                        <a class="item" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor

                @if ($endPage < $totalPages)
                    @if ($endPage < $totalPages - 1)
                        <span style="padding: 0 0.5rem;">...</span>
                    @endif
                    <a class="item" href="{{ $$paginator->url($totalPages) }}">{{ $totalPages }}</a>
                @endif
            @endif
        @endforeach



        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="icon item" href="{{ $paginator->nextPageUrl() }}" rel="next">
                <i class="right chevron icon next"></i> Next →</a>
        @else
            <a class="icon item disabled" aria-disabled="true"> <i class="right chevron icon next"></i> Next →</a>
        @endif
    </div>
    <div class="pagination-info mt-2">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} items
    </div>

@endif
