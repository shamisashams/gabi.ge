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
            <div class="help_category clicked">Top 5 most common questions</div>
            <div class="help_category">My order</div>
            <div class="help_category">Delivery</div>
            <div class="help_category">Claim</div>
            <div class="help_category">Returns & Exchange</div>
            <div class="help_category">Payment</div>
            <div class="help_category">Campaigns & offers</div>
        </div>
        <div class="help_content clicked">
            <div class="q_and_a open">
                <div class="q">Where is my package?</div>
                <div class="a">
                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                    It has roots in a piece of classical Latin literature from 45 BC,
                    making it over 2000 years old. Richard McClintock, a Latin professor
                    at Hampden-Sydney College in Virginia, looked up one of the more
                    obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                    going through the cites of the word in classical literature,
                    discovered the undoubtable source. Lorem Ipsum comes from sections
                    1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes
                    of Good and Evil) by Cicero, written in 45 BC. This book is a
                    treatise on the theory of ethics, very popular during the
                    Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit
                    amet..", comes from a line in section 1.10.32. <br /><br />
                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced
                    below for those interested. Sections 1.10.32 and 1.10.33 from "de
                    Finibus Bonorum et Malorum" by Cicero are also reproduced in their
                    exact original form, accompanied by English versions from the 1914
                    translation by H. Rackham.
                </div>
            </div>
            <div class="q_and_a">
                <div class="q">Has my order been placed?</div>
                <div class="a">no clue!</div>
            </div>
            <div class="q_and_a">
                <div class="q">How do I make a claim on a product?</div>
                <div class="a">no clue!</div>
            </div>
            <div class="q_and_a">
                <div class="q">How do I make a return?</div>
                <div class="a">no clue!</div>
            </div>
            <div class="q_and_a">
                <div class="q">How do I make an exchange?</div>
                <div class="a">no clue!</div>
            </div>
        </div>
        <div class="help_content">
            <div>My order</div>
        </div>
        <div class="help_content">
            <div>Delivery</div>
        </div>
        <div class="help_content">
            <div>Claim</div>
        </div>
        <div class="help_content">
            <div>Returns & Exchange</div>
        </div>
        <div class="help_content">
            <div>Payment</div>
        </div>
        <div class="help_content">
            <div>Campaigns & offers</div>
        </div>
    </section>


@endsection
