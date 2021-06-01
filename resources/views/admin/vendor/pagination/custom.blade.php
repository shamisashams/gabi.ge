<div style="text-align: right">
    @if ($paginator->hasPages())
        {{--    <div class="dataTables_info" id="data-table-simple_info" role="status" aria-live="polite">--}}
        {{--        Showing {{$paginator->perPage()}} - {{$paginator->total()}}--}}
        {{--    </div>--}}
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a href="" onclick="return false">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <a href="" onclick="return false">{{$page}}</a>
                            </li>
                        @else
                            <li class="waves-effect">
                                <a href="{{$url}}">{{$page}}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{--Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="waves-effect">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            @else
                <li class="waves-effect">
                    <a href="" onclick="return false" aria-label="@lang('pagination.next')">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            @endif
        </ul>
    @endif

</div>
