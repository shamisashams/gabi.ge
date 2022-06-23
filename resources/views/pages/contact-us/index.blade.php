@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_keyword:""}}">
    <link rel="canonical" href="{{route('proxy',[app()->getLocale(),isset($page_slugs['contact-us']['slug']) ? $page_slugs['contact-us']['slug'] : null])}}" />
    {!! jsonld('organization',[
            '@context'    => 'https://schema.org/',
            '@type'       => 'Organization',
            'url'         => route('welcome'),
            'name' => 'Gabi',
            'address' => [
                'streetAddress' => $address
            ],
            'contactPoint' => [
                'telephone' => $phone,
                'email' => $contact_email
            ]
        ])  !!}

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
                    'name' => __('client.contact_us'),
                    'url' => route('proxy',[app()->getLocale(),isset($page_slugs['contact-us']['slug']) ? $page_slugs['contact-us']['slug'] : null])
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
            <div class="current">{{__('client.contact')}}</div>
        </div>
    </section>

    <section class="contact_section wrapper flex">
        <div class="contact_info">
            <{{isset($page->h_tag->home) ? $page->h_tag->home : 'div'}} class="title">{{count($page->availableLanguage)>0?$page->availableLanguage[0]->title:""}}</{{isset($page->h_tag->home) ? $page->h_tag->home : 'div'}}>
            <p>
                {{count($page->availableLanguage)>0?$page->availableLanguage[0]->description:""}}
            </p>
            <div class="addresses">
                <div class="title">{{__('client.the_office')}}</div>
                <a target="_blank" href="http://maps.google.com/?q={{$address}}" class="address_link">
                    <img src="/img/icons/contact/1.png" alt=""/>
                    <p>{{$address}}</p>
                </a>
                <a href="tel:{{$phone}}" class="address_link">
                    <img src="/img/icons/contact/2.png" alt=""/>
                    <p>{{$phone}}</p>
                </a>
                <a href="mailto:{{$contact_email}}" class="address_link">
                    <img src="/img/icons/contact/3.png" alt=""/>
                    <p>{{$contact_email}}</p>
                </a>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1488.9922484408887!2d44.76718156962333!3d41.72085338019802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4044732798a254d7%3A0x24e743dcddcaeeff!2s11b%20Bakhtrioni%20St%2C%20T&#39;bilisi%200194!5e0!3m2!1sen!2sge!4v1655979838976!5m2!1sen!2sge" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="form">
            <div class="title">{{__('client.got_any_questions')}}</div>
            <form action="{{route('contactUs',app()->getLocale())}}" method="POST">
                @csrf
                <div class="input_grid">
                    <div class="input">
                        <input class="{{$errors->has('first_name')?'invalid':""}}" value="{{old('first_name')}}"
                               name="first_name" type="text" id="firstname"
                               placeholder="{{__('client.enter_first_name')}}"/>
                        <label for="firstname">{{__('client.first_name')}}</label>
                        @if ($errors->has('first_name'))
                            <div class="profile-error-block">{{ $errors->first('first_name') }}</div>
                        @endif
                    </div>
                    <div class="input ">
                        <input
                            class="{{$errors->has('last_name')?'invalid':""}}"
                            name="last_name"
                            type="text"
                            id="lastname"
                            value="{{old('last_name')}}"
                            placeholder="{{__('client.enter_last_name')}}"
                        />
                        <label for="lastname">{{__('client.last_name')}}</label>
                        @if ($errors->has('last_name'))
                            <div class="profile-error-block">{{ $errors->first('last_name') }}</div>
                        @endif
                    </div>
                    <div class="input">
                        <input
                            class="{{$errors->has('email')?'invalid':""}}"
                            name="email"
                            type="text"
                            id="emailadress"
                            value="{{old('email')}}"
                            placeholder="{{__('client.enter_email_address')}}"
                        />
                        <label for="emailadress">{{__('client.email_address')}}</label>
                        @if ($errors->has('email'))
                            <div class="profile-error-block">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="input">
                        <input
                            class="{{$errors->has('phone')?'invalid':""}}"
                            name="phone"
                            type="text"
                            id="phonenumber"
                            value="{{old('phone')}}"
                            placeholder="{{__('client.enter_phone')}}"
                        />
                        <label for="phonenumber">{{__('client.phone_number')}}</label>
                        @if ($errors->has('phone'))
                            <div class="profile-error-block">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                </div>
                <div class="input">
                    <label for="message">{{__('client.message')}}</label>
                    <textarea class="{{$errors->has('message')?'invalid':""}}" id="message" name="message"
                              placeholder="{{__('client.message')}}">{{old('message')}}</textarea>
                    @if ($errors->has('message'))
                        <div class="profile-error-block">{{ $errors->first('message') }}</div>
                    @endif
                </div>

                <button type="submit" class="send">{{__('client.send_message')}}</button>
            </form>
        </div>
    </section>

@endsection
