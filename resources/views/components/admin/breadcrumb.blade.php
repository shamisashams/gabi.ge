<div>
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    {{--                    @dd(request()->breadcrumbs()->segments());--}}
                    <h5 class="breadcrumbs-title mt-0 mb-0">
                        <span>{{is_numeric(request()->breadcrumbs()->segments()[2]->name()) ? request()->breadcrumbs()->segments()[2]->name() : __('admin.'.request()->breadcrumbs()->segments()[2]->name()) }}</span>
                    </h5>
                    <ol class="breadcrumbs mb-0">
                        @foreach(request()->breadcrumbs()->segments() as $key => $segment)
                            @if(!isset(request()->breadcrumbs()->segments()[$key+1]))
                                <li class="breadcrumb-item">
                                    <a href=""
                                       onclick="return false;">{{is_numeric($segment->name()) ? $segment->name() : __('admin.'.$segment->name()) }}</a>
                                </li>
                            @else
                                @if(!in_array($segment->name(),$globalLanguages['abbreviations']))
                                    <li class="breadcrumb-item">
                                        <a href="{{$segment->url()}}">{{is_numeric($segment->name()) ? $segment->name() : __('admin.'.$segment->name()) }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>
