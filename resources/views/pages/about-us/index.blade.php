@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_keyword:""}}">
    <link rel="canonical" href="{{route('proxy',[app()->getLocale(),isset($page_slugs['about-us']['slug']) ? $page_slugs['about-us']['slug'] : null])}}" />

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
                    'name' => __('client.about_us'),
                    'url' => route('proxy',[app()->getLocale(),isset($page_slugs['about-us']['slug']) ? $page_slugs['about-us']['slug'] : null])
                ],
            ],
        ])  !!}

    @foreach($globalLanguages['data'] as $lang)
        @if($lang['abbreviation'] == app()->getLocale())
            @continue
        @endif
        <?php


        $language_id = App\Models\Language::getIdByName($lang['abbreviation']);
        $cat = App\Models\PageLanguage::query()->where('page_id',$page->id)->where('language_id',$language_id)->first();

        ?>

        @if($cat)
            <link rel="alternate" hreflang="{{$lang['locale']}}" href="{{route('proxy',[$lang['abbreviation'],$cat->slug])}}" />
        @endif

    @endforeach
@endsection

@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a>
            </div>
            <{{isset($page->h_tag->home) ? $page->h_tag->home : 'div'}} class="current">{{__('client.about_us')}}</{{isset($page->h_tag->home) ? $page->h_tag->home : 'div'}}>
        </div>
    </section>


    <section class="about_us_section wrapper flex">
        <div class="left">
            <div>
                {!!count($page->availableLanguage)>0?$page->availableLanguage[0]->content:""!!}
            </div>
            <br>
            <div>
                {!!count($page->availableLanguage)>0?$page->availableLanguage[0]->content_2:""!!}
            </div>
        </div>
        <div class="who_we_are">
            {!!count($page->availableLanguage)>0?$page->availableLanguage[0]->content_3:""!!}
        </div>
    </section>

@endsection
