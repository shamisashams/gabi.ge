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
            <h4 style="color: #153116;">Success!</h4>
            <p>Thank you for being our valued customer. <br>
            We are so grateful for the pleasure of serving you and hope we met your expectations.</p>
            <img src="/img/icons/result/1.png" alt=""/>
            <a href="{{route('welcome')}}" class="result_btn">Return to home page</a>
        </div>
    </section>

@endsection
