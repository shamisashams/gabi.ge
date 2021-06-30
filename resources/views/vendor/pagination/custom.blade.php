<div class="pagination">
    @if($paginator->hasPages())
        @if ($paginator->onFirstPage())
            <a href="" onclick="return false" class="prev_page">{{__('client.previous')}}</a>
        @else
            <a style="color:#2d2d2d"  href="{{ $paginator->previousPageUrl() }}" class="prev_page">{{__('client.previous')}}</a>
        @endif
        <div class="pagination_slides">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="" class="page_number active">{{$page}}</a>
                        @else
                            <a href="{{$url}}" class="page_number">{{$page}}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
        @if ($paginator->hasMorePages())
            <a style="color:#2d2d2d"  href="{{ $paginator->nextPageUrl() }}" class="next_page">{{__('client.next')}}</a>

        @else
            <a  href="" onclick="return false" class="next_page">{{__('client.next')}}</a>
        @endif
    @endif
</div>
