@extends('layouts.base')
@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took">Home / Login - Sing Up</div>
            <div class="current">
                <div class="current_lisu on">Login</div>
                <div class="current_lisu">Sign up</div>
            </div>
        </div>
    </section>

    <section class="login_signup_box">
        <div class="head">
            <button class="lisu_navigation active">{{__('client.login')}}</button>
            <button class="lisu_navigation">{{__('client.sign_up')}}</button>
        </div>
        <div class="content">
            <div class="lisu_content">
                <form action="{{route('loginFront',app()->getLocale())}}"  class="form lisu_form_alt opened" method="POST">
                    @csrf
                    <div class="label">{{__('client.login')}}</div>
                    <input value="{{old('loginEmail')}}" name="loginEmail" class="roboto {{$errors->has('loginEmail')?'invalid':""}}" type="text" placeholder="example@email.com" />
                    @if ($errors->has('loginEmail'))
                        <p class="error-block">{{ $errors->first('loginEmail') }}</p>
                    @endif
                    <div class="label">{{__('client.password')}}</div>
                    <input class="{{$errors->has('loginPassword')?'invalid':""}}" name="loginPassword" type="password" placeholder="•••••••••" />
                    @if ($errors->has('loginPassword'))
                        <p class="error-block">{{ $errors->first('loginPassword') }}</p>
                    @endif
                    @if ($errors->has('auth'))
                        <p class="error-block">{{ $errors->first('auth') }}</p>
                    @endif
                    <button class="lisu_btn">{{__('client.login')}}</button>
                    <!-- <a href="{{route('fb-redirect')}}">facebook</a>
                    <a href="{{route('google-redirect')}}">google</a> -->
                    <div class="sign_with">
                       <div class="title">{{__('client.or_sign_in_with')}}</div>
                       <div class="">
                           <a href="{{route('google-redirect')}}" class="accs">
                               <img src="/img/icons/login/1.png" alt="" />
                               <p>{{__('client.login_with_google')}}</p>
                           </a>
                           <a href="{{route('fb-redirect')}}" class="accs">
                               <img src="/img/icons/login/2.png" alt="" />
                               <p>{{__('client.login_with_facebook')}}</p>
                           </a>
                       </div>
                   </div>
                </form>

                <form method="POST" action="{{route('register',app()->getLocale())}}" class="form lisu_form_alt">
                    @csrf

                    <div class="label">{{__('client.first_name')}}</div>
                    <input class="roboto {{$errors->has('first_name')?'invalid':""}}" value="{{old('first_name')}}" name="first_name" type="text" placeholder="{{__('client.enter_your_name')}}" />
                    @if ($errors->has('first_name'))
                        <p class="error-block">{{ $errors->first('first_name') }}</p>
                    @endif

                    <div class="label">{{__('client.last_name')}}</div>
                    <input
                        name="last_name"
                        class="roboto {{$errors->has('last_name')?'invalid':""}}"
                        type="text"
                        value="{{old('last_name')}}"
                        placeholder="{{__('client.enter_your_last_name')}}"
                    />
                    @if ($errors->has('last_name'))
                        <p class="error-block">{{ $errors->first('last_name') }}</p>
                    @endif

                    <div class="label">{{__('client.email_address')}}</div>
                    <input value="{{old('email')}}" name="email" class="roboto {{$errors->has('email')?'invalid':""}}" type="email" placeholder="example@email.com" />
                    @if ($errors->has('email'))
                        <p class="error-block">{{ $errors->first('email') }}</p>
                    @endif

                    <div class="label">{{__('client.password')}}</div>
                    <input  name="password" class="{{$errors->has('email')?'invalid':""}}" type="password" placeholder="•••••••••" />
                    @if ($errors->has('password'))
                        <p class="error-block">{{ $errors->first('password') }}</p>
                    @endif

                    <div class="label">{{__('client.password_repeat')}}</div>
                    <input name="password_repeat" class="{{$errors->has('password_repeat')?'invalid':""}}" type="password" placeholder="•••••••••" />
                    @if ($errors->has('password_repeat'))
                        <p class="error-block">{{ $errors->first('password_repeat') }}</p>
                    @endif

                    <div class="label">{{__('client.choose_country')}}</div>
                    <input value="{{old('country')}}" name="country" type="text" class="{{$errors->has('country')?'invalid':""}}" placeholder="Georgia" />
                    @if ($errors->has('country'))
                        <p class="error-block">{{ $errors->first('country') }}</p>
                    @endif

                    <button class="lisu_btn">{{__('client.register_account')}}</button>

                    <div class="sign_with">
                        <div class="title">{{__('client.or_sign_in_with')}}</div>
                        <div class="">
                            <a href="{{route('google-redirect')}}" class="accs">
                                <img src="/img/icons/login/1.png" alt="" />
                                <p>{{__('client.login_with_google')}}</p>
                            </a>
                            <a href="{{route('fb-redirect')}}" class="accs">
                                <img src="/img/icons/login/2.png" alt="" />
                                <p>{{__('client.login_with_facebook')}}</p>
                            </a>
                        </div>
                    </div>
                </form>
{{--                <div class="sign_with">--}}
{{--                    <div class="title">{{__('client.or_sign_in_with')}}</div>--}}
{{--                    <div class="flex">--}}
{{--                        <a href="#" class="accs">--}}
{{--                            <img src="/img/icons/login/1.png" alt="" />--}}
{{--                            <p>{{__('client.login_with_google')}}</p>--}}
{{--                        </a>--}}
{{--                        <a href="{{route('facebookAuth')}}" class="accs">--}}
{{--                            <img src="/img/icons/login/2.png" alt="" />--}}
{{--                            <p>{{__('client.login_with_facebook')}}</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
@endsection
