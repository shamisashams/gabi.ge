@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_keyword:""}}">
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
