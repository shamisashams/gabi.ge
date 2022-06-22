@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_keyword:""}}">
    <link rel="canonical" href="{{route('proxy',[app()->getLocale(),isset($page_slugs['helps']['slug']) ? $page_slugs['helps']['slug'] : null])}}" />

    {!! jsonld('breadcrumb_list',[
            '@context'    => 'https://schema.org/',
            '@type'       => 'BreadcrumbList',
            'itemListElement'         => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => __('client.home'),
                    'url' => route('welcome')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => __('client.helps'),
                    'url' => route('proxy',[app()->getLocale(),isset($page_slugs['helps']['slug']) ? $page_slugs['helps']['slug'] : null])
                ],
            ],
        ])  !!}
@endsection

@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a></div>
            <{{isset($page->h_tag->home) ? $page->h_tag->home : 'div'}} class="current">@lang('client.helps')</{{isset($page->h_tag->home) ? $page->h_tag->home : 'div'}}>
        </div>
    </section>

    <section class="help_center wrapper flex">
        <div class="list">
            <div class="help_category clicked">@lang('client.faq_title')</div>
            @foreach($helps as $help)
            <div class="help_category">{!! isset($help->h_tag->home) ? '<' .$help->h_tag->home . '>' : '' !!}{{count($help->availableLanguage)>0?$help->availableLanguage[0]->title:""}}{!! isset($help->h_tag->home) ? '</' . $help->h_tag->home . '>' : '' !!}</div>
            @endforeach
        </div>
        <div class="help_content clicked">
            @foreach($faqs as $faq)
            <div class="q_and_a {{$loop->iteration == 1 ? 'open':''}}">
                <div class="q">{!! isset($faq->h_tag->home) ? '<' .$faq->h_tag->home . '>' : '' !!}{{count($faq->availableLanguage)>0?$faq->availableLanguage[0]->question:""}}{!! isset($faq->h_tag->home) ? '</' .$faq->h_tag->home . '>' : '' !!}</div>
                <div class="a">
                    {!! count($faq->availableLanguage)>0?$faq->availableLanguage[0]->answer:"" !!}
                </div>
            </div>
            @endforeach

        </div>
        @foreach($helps as $help)
        <div class="help_content">
            <div>{!! count($help->availableLanguage)>0?$help->availableLanguage[0]->text:"" !!}</div>
        </div>
        @endforeach

    </section>


@endsection
