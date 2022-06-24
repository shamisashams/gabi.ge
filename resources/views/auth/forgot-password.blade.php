@extends('layouts.base')
@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a></div>
            <div class="current">
                <div class="current_lisu on">{{__('client.forgot_password')}}</div>
                <div class="current_lisu">Sign up</div>
            </div>
        </div>
    </section>

    <section class="login_signup_box">
        <div class="head">
            <button class="lisu_navigation active">{{__('client.forgot_password_f')}}</button>
        </div>
        <div class="content">
            <div class="lisu_content">
                <form action="{{route('password.email',app()->getLocale())}}"  class="form lisu_form_alt opened" method="POST">
                    @csrf
                    <div class="label">{{__('client.email')}}</div>
                    <input value="{{old('loginEmail')}}" name="email" class="roboto {{$errors->has('loginEmail')?'invalid':""}}" type="text" placeholder="example@email.com" />
                    @if ($errors->has('email'))
                        <p class="error-block">{{ $errors->first('email') }}</p>
                    @endif

                    <button class="lisu_btn">{{__('client.send')}}</button>

                </form>



            </div>
        </div>
    </section>

    @if(session('status'))
    <div class="commonPopup subscribe_popup show">
        <div class="commonPopupContainer ">
            <div class="flex center success">
                <img src="/img/icons/tick.png" alt="" />
                <div>Success!</div>
            </div>
            <p>Your password has been successfully reset.</p>
            <div class="flex center btnflex">
                <a href="{{route('welcome')}}">
                    <button>Back To Home Page</button>
                </a>
            </div>
        </div>
    </div>
    @endif
@endsection
