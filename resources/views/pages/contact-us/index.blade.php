@extends('layouts.base')

@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a> / {{__('client.contact')}}
            </div>
            <div class="current">{{__('client.contact')}}</div>
        </div>
    </section>

    <section class="contact_section wrapper flex">
        <div class="contact_info">
            <div class="title">{{$page->title?:""}}</div>
            <p>
                {{$page->description?:""}}
            </p>
            <div class="addresses">
                <div class="title">{{__('client.the_office')}}</div>
                <a href="#" class="address_link">
                    <img src="/img/icons/contact/1.png" alt=""/>
                    <p>{{$address}}</p>
                </a>
                <a href="#" class="address_link">
                    <img src="/img/icons/contact/2.png" alt=""/>
                    <p>{{$phone}}</p>
                </a>
                <a href="#" class="address_link">
                    <img src="/img/icons/contact/3.png" alt=""/>
                    <p>{{$contact_email}}</p>
                </a>
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
