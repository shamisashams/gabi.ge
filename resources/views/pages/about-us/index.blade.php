@extends('layouts.base')

@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a> / {{__('client.about_us')}}
            </div>
            <div class="current">{{__('client.about_us')}}</div>
        </div>
    </section>


    <section class="about_us_section wrapper flex">
        <div class="left">
            <div>
                {!!$page->content?:""!!}
            </div>
            <br>
            <div>
                {!!$page->content_2?:""!!}
            </div>
        </div>
        <div class="who_we_are">
            {!!$page->content_3?:""!!}
        </div>
    </section>

@endsection
