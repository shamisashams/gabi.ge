@extends('layouts.base')
@section('head')
    {{--    <title>{{__('app.title_home')}}</title>--}}
@endsection

@section('content')
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took">Home / shop / shopping cart</div>
            <div class="current">shopping cart</div>
        </div>
    </section>

    <section class="profile_section wrapper flex">
        <div class="profile_tabs">
            <div class="row flex head">
                <div class="title roboto">
                    Welcome To <br/>
                    <span class="bold roboto">Khaladze</span>
                </div>
                <div class="icn">
                    <img src="img/icons/profile/user.png" alt=""/>
                </div>
            </div>
            <div class="row middle">
                <div class="link profile_tab_name clicked">{{__('client.my_profiles')}}</div>
                <div class="link profile_tab_name">{{__('client.order_history')}}</div>
                <div class="link profile_tab_name">{{__('client.change_password')}}</div>
            </div>
            <div class="row last">
                <a href="helps.html" class="link">{{__('client.helps')}}</a>
                <a href="contact.html" class="link">{{__('client.contact_us')}}</a>
            </div>
            <button class="log_out">Log Out</button>
        </div>
        <div class="profile_tabs_content clicked">
            @include('layouts.alert.alert')
            <div class="title">{{__('client.change_your_profile')}}</div>
            <form method="post" action="{{route('profileUpdate',app()->getLocale())}}">
                @csrf
                <div class="input_grid">
                    <div class="input">
                        <label for="">{{__('client.first_name')}}</label>
                        <input value="{{$user->profile->first_name}}" class="{{$errors->has('first_name')?'invalid':""}}" name="first_name" type="text " placeholder="Enter your name"/>
                        @if ($errors->has('first_name'))
                            <p class="profile-error-block">{{ $errors->first('first_name') }}</p>
                        @endif

                    </div>
                    <div class="input">
                        <label for="">{{__('client.last_name')}}</label>
                        <input value="{{$user->profile->last_name}}" class="{{$errors->has('last_name')?'invalid':""}}" name="last_name" type="text " placeholder="Enter your last name"/>
                        @if ($errors->has('last_name'))
                            <p class="profile-error-block">{{ $errors->first('last_name') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.email_address')}}</label>
                        <input disabled value="{{$user->email}}" name="email" type="text" placeholder="example@email.com"/>
                    </div>
                    <div class="input">
                        <label for="">{{__('client.phone')}}</label>
                        <input value="{{$user->profile->phone}}"  class="{{$errors->has('phone')?'invalid':""}}" name="phone" type="tel" placeholder="+995 595 555 999 999"/>
                        @if ($errors->has('phone'))
                            <p class="profile-error-block">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.choose_country')}}</label>
                        <input value="{{$user->profile->country}}" class="{{$errors->has('country')?'invalid':""}}" name="country" type="text" placeholder="Georgia"/>
                        @if ($errors->has('country'))
                            <p class="profile-error-block">{{ $errors->first('country') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.choose_city')}}</label>
                        <input value="{{$user->profile->city}}" class="{{$errors->has('city')?'invalid':""}}"  name="city" type="text" placeholder="Tbilisi"/>
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
        <div class="profile_tabs_content">
            <div class="title">{{__('client.order_history')}}</div>
            <div class="order_table">
                <div class="head flex">
                    <div class="c1">Products</div>
                    <div class="c2">Price</div>
                    <div class="c2">Status</div>
                    <div class="c2">Downloads PDF</div>
                </div>
                <div class="ordered_item flex">
                    <div class="c1">
                        <div style="color: #808080">1 x</div>
                        <div class="img">
                            <img src="img/products/10.png" alt=""/>
                        </div>
                        <div>Floral Print Dress Blue</div>
                    </div>
                    <div class="c2">$65.00</div>
                    <div class="c2 green">Delivery</div>
                    <button class="c2" class="dl">
                        <img src="img/icons/profile/download.png" alt=""/>
                    </button>
                </div>
                <div class="ordered_item flex">
                    <div class="c1">
                        <div style="color: #808080">1 x</div>
                        <div class="img">
                            <img src="img/products/10.png" alt=""/>
                        </div>
                        <div>Floral Print Dress Blue</div>
                    </div>
                    <div class="c2">$65.00</div>
                    <div class="c2 green">Delivery</div>
                    <button class="c2" class="dl">
                        <img src="img/icons/profile/download.png" alt=""/>
                    </button>
                </div>
                <div class="ordered_item flex">
                    <div class="c1">
                        <div style="color: #808080">1 x</div>
                        <div class="img">
                            <img src="img/products/10.png" alt=""/>
                        </div>
                        <div>Floral Print Dress Blue</div>
                    </div>
                    <div class="c2">$65.00</div>
                    <div class="c2 red">Canceled</div>
                    <button class="c2" class="dl">
                        <img src="img/icons/profile/download.png" alt=""/>
                    </button>
                </div>
                <div class="ordered_item flex">
                    <div class="c1">
                        <div style="color: #808080">1 x</div>
                        <div class="img">
                            <img src="img/products/10.png" alt=""/>
                        </div>
                        <div>Floral Print Dress Blue</div>
                    </div>
                    <div class="c2">$65.00</div>
                    <div class="c2 red">Canceled</div>
                    <button class="c2" class="dl">
                        <img src="img/icons/profile/download.png" alt=""/>
                    </button>
                </div>
                <div class="ordered_item flex">
                    <div class="c1">
                        <div style="color: #808080">1 x</div>
                        <div class="img">
                            <img src="img/products/10.png" alt=""/>
                        </div>
                        <div>Floral Print Dress Blue</div>
                    </div>
                    <div class="c2">$65.00</div>
                    <div class="c2 yellow">Processing</div>
                    <button class="c2" class="dl">
                        <img src="img/icons/profile/download.png" alt=""/>
                    </button>
                </div>
            </div>
        </div>
        <div class="profile_tabs_content">
            <div class="title">Change Your Password</div>
            <div class="input_grid">
                <div class="input">
                    <label for="">Old Password</label>
                    <input type="password " placeholder="•••••••••••••"/>
                </div>
                <div></div>
                <div class="input">
                    <label for="">New Password</label>
                    <input type="password " placeholder="•••••••••••••"/>
                </div>
                <div class="input">
                    <label for="">Repeat password</label>
                    <input type="password " placeholder="•••••••••••••"/>
                </div>
            </div>
            <button class="update">Update</button>
        </div>
    </section>

@endsection
