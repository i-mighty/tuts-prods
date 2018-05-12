@if ($paginator->hasPages())
    <div class="post-pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <button class="pagination-back pull-left disabled" disabled></button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-back pull-left">Back</a>
                @endif
                <ul class="pages">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </ul>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-next pull-right">Next</a>
            @else
                <button class="pagination-next pull-right disabled" disabled></button>
            @endif
    </div>
@endif
