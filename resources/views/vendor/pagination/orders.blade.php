<div class="pagination">
    @if ($paginator->hasPages())
        {{--    <div class="dataTables_info" id="data-table-simple_info" role="status" aria-live="polite">--}}
        {{--        Showing {{$paginator->perPage()}} - {{$paginator->total()}}--}}
        {{--    </div>--}}
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <a href="" onclick="return false" style="color:#2d2d2d;font-size: 15px" class="prev_page">
                    {{__('client.previous')}}
                </a>
            @else
                <a href="{{ $paginator->previousPageUrl().'&type=order' }}" style="color:#2d2d2d;font-size: 15px"
                   class="prev_page">
                    {{__('client.previous')}}
                </a>
            @endif
            {{-- Pagination Elements --}}
            <div class="pagination_slides">
                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a style="margin-right: 15px;" href="" onclick="return false"
                                   class="page_number active">{{$page}}</a>
                            @else
                                <a style="margin-right: 15px" href="{{$url.'&type=order'}}"
                                   class="page_number">{{$page}}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{--Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl().'&type=order' }}" style="color:#2d2d2d;font-size: 15px"
                   class="next_page">
                    {{__('client.next')}}
                </a>
            @else
                <a href="" onclick="return false" style="color:#2d2d2d;font-size: 15px" class="next_page">
                    {{__('client.next')}}
                </a>
            @endif
        </ul>
    @endif

</div>
