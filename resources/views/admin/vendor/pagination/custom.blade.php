{{--<ul class="pagination">--}}
{{--    <li class="disabled">--}}
{{--        <a href="#!">--}}
{{--            <i class="material-icons">chevron_left</i>--}}
{{--        </a>--}}
{{--    </li>--}}
{{--    <li class="active"><a href="#!">1</a>--}}
{{--    </li>--}}
{{--    <li class="waves-effect"><a href="#!">2</a>--}}
{{--    </li>--}}
{{--    <li class="waves-effect"><a href="#!">3</a>--}}
{{--    </li>--}}
{{--    <li class="waves-effect"><a href="#!">4</a>--}}
{{--    </li>--}}
{{--    <li class="waves-effect"><a href="#!">5</a>--}}
{{--    </li>--}}
{{--    <li class="waves-effect">--}}
{{--        <a href="#!">--}}
{{--            <i class="material-icons">chevron_right</i>--}}
{{--        </a>--}}
{{--    </li>--}}
{{--</ul>--}}
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
    @else
        <div class="dataTables_paginate paging_simple_numbers" id="data-table-simple_paginate"></div>
        {{--            <div class="dataTables_info" id="data-table-simple_info" role="status" aria-live="polite">--}}
        {{--                {{trans('showing_records')}}  {{$paginator->total()}} - {{$paginator->total()}}--}}
        {{--            </div>--}}
        <ul class="pagination">
            <li class="disabled">
                <a href="" onclick="return false">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>

            <li class="active">
                <a href="" onclick="return false">1</a>
            </li>
            <li class="waves-effect">
                <a href="" onclick="return false">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        </ul>
@endif

</div>
