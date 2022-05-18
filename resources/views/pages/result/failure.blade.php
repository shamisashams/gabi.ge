@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
@endsection
@section('description'){{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->description : null}}@endsection
@section('keywords'){{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->description : null}}@endsection
@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a> / <a href="#">shop </a> / Checkout
            </div>
            <div class="current">Checkout</div>
        </div>
    </section>

    <section class="result_page wrapper ">
        <div class="result_container">
            <h4 style="color: #8B3737">Sorry, something went wrong</h4>
            <p>there was an unexpected error please check and try again</p>
            <img src="/img/icons/result/2.png" alt=""/>
            <a href="{{route('welcome')}}" class="result_btn">Back to check out</a>
        </div>
    </section>

@endsection
