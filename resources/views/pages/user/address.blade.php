@extends('layouts.base')
@section('head')
    <title>{{__('app.profile')}}</title>
@endsection

@section('content')
    <section class="profile_section wrapper flex">
        <div class="profile_tabs_content clicked">
            <div class="input country">
                <label for="">{{__('client.country')}}</label>
                <input
                    type="text"
                    name="country"
                    class="{{$errors->has('address')?'invalid':""}}"
                    placeholder="Georgia"
                />
                @if ($errors->has('country'))
                    <p class="profile-error-block">{{ $errors->first('country') }}</p>
                @endif
            </div>

            <div class="input country">
                <label for="">{{__('client.city')}}</label>
                <input
                    type="text"
                    name="city"
                    class="{{$errors->has('city')?'invalid':""}}"
                    placeholder="city"
                />
                @if ($errors->has('city'))
                    <p class="profile-error-block">{{ $errors->first('city') }}</p>
                @endif
            </div>

            <div class="input country">
                <label for="">{{__('client.phone')}}</label>
                <input
                    type="text"
                    name="phone"
                    class="{{$errors->has('phone')?'invalid':""}}"
                    placeholder="phone"
                />
                @if ($errors->has('phone'))
                    <p class="profile-error-block">{{ $errors->first('phone') }}</p>
                @endif
            </div>

            <div class="input country">
                <label for="">{{__('client.postal_code')}}</label>
                <input
                    type="text"
                    name="postal_code"
                    class="{{$errors->has('postal_code')?'invalid':""}}"
                    placeholder="postal_code"
                />
                @if ($errors->has('postal_code'))
                    <p class="profile-error-block">{{ $errors->first('postal_code') }}</p>
                @endif
            </div>

            <div class="input country">
                <label for="">{{__('client.address_line_1')}}</label>
                <input
                    type="text"
                    name="address_1"
                    class="{{$errors->has('address_1')?'invalid':""}}"
                    placeholder="address_1"
                />
                @if ($errors->has('address_1'))
                    <p class="profile-error-block">{{ $errors->first('address_1') }}</p>
                @endif
            </div>

            <div class="input country">
                <label for="">{{__('client.address_2')}}</label>
                <input
                    type="text"
                    name="address_2"
                    class="{{$errors->has('address_2')?'invalid':""}}"
                    placeholder="address_2"
                />
                @if ($errors->has('address_2'))
                    <p class="profile-error-block">{{ $errors->first('address_2') }}</p>
                @endif
            </div>

            <div class="input country">
                <label for="">{{__('client.name')}}</label>
                <input
                    type="text"
                    name="name"
                    class="{{$errors->has('name')?'invalid':""}}"
                    placeholder="name"
                />
                @if ($errors->has('name'))
                    <p class="profile-error-block">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="input country">
                <label for="">{{__('client.surname')}}</label>
                <input
                    type="text"
                    name="surname"
                    class="{{$errors->has('surname')?'invalid':""}}"
                    placeholder="surname"
                />
                @if ($errors->has('surname'))
                    <p class="profile-error-block">{{ $errors->first('surname') }}</p>
                @endif
            </div>
        </div>
    </section>


@endsection
