@extends('layouts.base')
@section('head')
        <title>{{__('app.profile')}}</title>
@endsection

@section('content')
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome',app()->getLocale())}}">{{__('client.home')}} </a>
                </div>
            <div class="current">{{__('client.profile')}}</div>
        </div>
    </section>

    <section class="profile_section wrapper flex">
        <div class="profile_tabs">
            <div class="row flex head">
                <div class="title roboto">
                    {{__('client.welcome_to')}} <br/>
                    <span class="bold roboto">{{$user->name}}</span>
                </div>
                <div class="icn">
                    <img src="img/icons/profile/user.png" alt=""/>
                </div>
            </div>
            <div class="row middle">
                <div id="tab-profile" class="link profile_tab_name clicked"
                     onclick="changeType('profile')">{{__('client.my_profiles')}}</div>
                <div id="tab-order" class="link profile_tab_name"
                     onclick="changeType('order')">{{__('client.order_history')}}</div>
                <div id="tab-password" class="link profile_tab_name"
                     onclick="changeType('password')">{{__('client.change_password')}}</div>
            </div>
            <div class="row last">
                <a href="{{route('client.helps')}}" class="link">{{__('client.helps')}}</a>
                <a href="{{route('client.contact_us')}}" class="link">{{__('client.contact_us')}}</a>
            </div>
            <button onclick="window.location.href='{{route('logoutFront',app()->getLocale())}}'"
                    class="log_out">{{__('client.log_out')}}</button>
        </div>
        <div class="profile_tabs_content clicked">
            @include('layouts.alert.alert')
            <div class="title">{{__('client.change_your_profile')}}</div>
            <form method="post" action="{{route('profileUpdate',app()->getLocale())}}">
                @csrf
                <div class="input_grid">
                    <div class="input">
                        <label for="">{{__('client.first_name')}}</label>
                        <input value="{{$user->profile->first_name}}"
                               class="{{$errors->has('first_name')?'invalid':""}}" name="first_name" type="text "
                               placeholder="Enter your name"/>
                        @if ($errors->has('first_name'))
                            <p class="profile-error-block">{{ $errors->first('first_name') }}</p>
                        @endif

                    </div>
                    <div class="input">
                        <label for="">{{__('client.last_name')}}</label>
                        <input value="{{$user->profile->last_name}}" class="{{$errors->has('last_name')?'invalid':""}}"
                               name="last_name" type="text " placeholder="Enter your last name"/>
                        @if ($errors->has('last_name'))
                            <p class="profile-error-block">{{ $errors->first('last_name') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.email_address')}}</label>
                        <input disabled value="{{$user->email}}" name="email" type="text"
                               placeholder="example@email.com"/>
                    </div>
                    <div class="input">
                        <label for="">{{__('client.phone')}}</label>
                        <input value="{{$user->profile->phone}}" class="{{$errors->has('phone')?'invalid':""}}"
                               name="phone" type="tel" placeholder="+995 595 555 999 999"/>
                        @if ($errors->has('phone'))
                            <p class="profile-error-block">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.choose_country')}}</label>
                        <input value="{{$user->profile->country}}" class="{{$errors->has('country')?'invalid':""}}"
                               name="country" type="text" placeholder="Georgia"/>
                        @if ($errors->has('country'))
                            <p class="profile-error-block">{{ $errors->first('country') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.choose_city')}}</label>
                        <input value="{{$user->profile->city}}" class="{{$errors->has('city')?'invalid':""}}"
                               name="city" type="text" placeholder="Tbilisi"/>
                        @if ($errors->has('city'))
                            <p class="profile-error-block">{{ $errors->first('city') }}</p>
                        @endif
                    </div>
                </div>
                <div class="input address">
                    <label for="">{{__('client.choose_address')}}</label>
                    <input
                        type="text"
                        name="address"
                        class="{{$errors->has('address')?'invalid':""}}"
                        value="{{$user->profile->address}}"
                        placeholder="Georgia, Tbilisi - Didi Dighomi III Micro-District"
                    />
                    @if ($errors->has('address'))
                        <p class="profile-error-block">{{ $errors->first('address') }}</p>
                    @endif
                </div>
                <button class="update">{{__('client.update')}}</button>
            </form>

            <div class="your_address">
                <div class="title">{{__('client.your_address')}}</div>
                <div class="address_table">
                    <div class="head flex">
                        <div>{{__('client.name')}}</div>
                        <div>{{__('client.phone_number')}}</div>
                        <div>{{__('client.address')}}</div>
                    </div>
                    <div class="info flex">
                        <div>{{$user->name}}</div>
                        <div>{{$user->profile->phone}}</div>
                        <div>{{$user->profile->address}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tabs_content_order" class="profile_tabs_content">
            <div class="title">{{__('client.order_history')}}</div>
            <div class="order_table">
                <div class="head flex">
                    <div class="c2">{{__('client.order_id')}}</div>
                    <div class="c2">{{__('client.order_date')}}</div>
                    <div class="c2">{{__('client.order_price')}}</div>
                    <div class="c2">{{__('client.order_status')}}</div>
                    <div class="c2">{{__('client.order_view')}}</div>
                </div>
                @foreach($orders as $order)
                    <div class="ordered_item flex">
                        <div class="c2">{{$order->id}}</div>
                        <div class="c2">{{$order->created_at}}</div>
                        <div class="c2">₾{{round($order->total_price/100,2)}}</div>
                        @if($order->status==\App\Models\Order::STATUS_PENDING)
                            <div class="c2 green">{{__('client.pending')}}</div>
                        @elseif($order->status==\App\Models\Order::STATUS_FAIL)
                            <div class="c2 red">{{__('client.fail')}}</div>
                        @else
                            <div class="c2 green">{{__('client.success')}}</div>

                        @endif
                        <a
                            href="{{route('orderDetails',[app()->getLocale(),$order->id])}}"
                            class="c2 dl view_order_detail"
                        >
                            <img src="/img/icons/profile/view.svg" alt=""/>
                        </a>
                    </div>
                @endforeach
            </div>
            {{$orders->appends(request()->query())->links('vendor.pagination.orders')}}
        </div>
        <div class="profile_tabs_content">
            <div class="title">{{__('client.change_your_password')}}</div>
            <form method="post" action="{{route('changePassword',app()->getLocale())}}">
                @csrf
                <div class="input_grid">
                    <div class="input">
                        <label for="">{{__('client.old_password')}}</label>
                        <input value="{{old('old_password')}}" class="{{$errors->has('old_password')?"invalid":""}}"
                               name="old_password" type="password" placeholder="•••••••••••••"/>
                        @if ($errors->has('old_password'))
                            <p class="profile-error-block">{{ $errors->first('old_password') }}</p>
                        @endif
                    </div>
                    <div></div>
                    <div class="input">
                        <label for="">{{__('client.new_password')}}</label>
                        <input value="{{old('password')}}" class="{{$errors->has('password')?"invalid":""}}"
                               name="password" type="password" placeholder="•••••••••••••"/>
                        @if ($errors->has('password'))
                            <p class="profile-error-block">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.repeat_password')}}</label>
                        <input value="{{old('password_repeat')}}"
                               class="{{$errors->has('password_repeat')?"invalid":""}}" name="password_repeat"
                               type="password" placeholder="•••••••••••••"/>
                        @if ($errors->has('password_repeat'))
                            <p class="profile-error-block">{{ $errors->first('password_repeat') }}</p>
                        @endif
                    </div>
                </div>
                <button class="update">{{__('client.update')}}</button>
            </form>
        </div>
    </section>

@endsection
