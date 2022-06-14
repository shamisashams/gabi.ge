@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_keyword:""}}">
@endsection

@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a></div>
            <div class="current">@lang('client.helps')</div>
        </div>
    </section>

    <section class="help_center wrapper flex">
        <div class="list">
            <div class="help_category clicked">@lang('client.faq_title')</div>
            @foreach($helps as $help)
            <div class="help_category">{{count($help->availableLanguage)>0?$help->availableLanguage[0]->title:""}}</div>
            @endforeach
        </div>
        <div class="help_content clicked">
            @foreach($faqs as $faq)
            <div class="q_and_a {{$loop->iteration == 1 ? 'open':''}}">
                <div class="q">{{count($faq->availableLanguage)>0?$faq->availableLanguage[0]->question:""}}</div>
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
