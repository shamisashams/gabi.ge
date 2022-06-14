@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_keyword:""}}">
@endsection

@section('content')


    <section class="blogs_page wrapper">
        <div class="showcase flex center">
            <div class="showcase_innerbox flex center">
                <div class="bold">@lang('client.page_blog_header')</div>
                <p>@lang('client.page_blog_subtitle')</p>
            </div>
        </div>
        <div class="blog_grid">
            {{--@dd($blogs)--}}
            @foreach($blogs as $blog)
            <a href="{{route('viewBlog',[app()->getLocale(),count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->slug : ''])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                   {{-- @dump($blog->firstImage)--}}
                    <div class="img">
                        <img src="{{asset($blog->firstImage ? ('storage/blog/' . $blog->firstImage->fileable_id .'/'. $blog->firstImage->name) : null)}}" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">{{count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->title : ''}}</div>
                        <div class="date shallow">{{$blog->created_at}}</div>
                    </div>
                    <div>
                        {{--<div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>--}}
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>{{$blog->views}}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

        </div>

        {{ $blogs->appends(request()->query())->links('vendor.pagination.custom') }}
        {{--<div class="pagination flex center">
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
        </div>--}}
    </section>


@endsection
