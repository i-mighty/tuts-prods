@if ($paginator->hasPages())
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="pagination-back pull-left disabled" disabled>@lang('pagination.previous')</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-back" style="margin: 10px">Back</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-next" style="margin: 10px">Next</a>
        @else
            <button class="pagination-next pull-right disabled" disabled>@lang('pagination.next')</button>
        @endif
@endif
