@extends('layouts.base')
@section('content')

    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">{{__('client.home')}}</a></div>
            <div class="current">
                <div class="current_lisu on">{{__('client.reset_password')}}</div>
                <div class="current_lisu">Sign up</div>
            </div>
        </div>
    </section>

    <section class="login_signup_box">
        <div class="head">
            <button class="lisu_navigation active">{{__('client.reset_password_f')}}</button>

        </div>
        <div class="content">
            <div class="lisu_content">
                <form action="{{route('password.update',app()->getLocale())}}"  class="form lisu_form_alt opened" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <input type="hidden" name="email" value="{{$email}}">


                    <div class="label">{{__('client.password')}}</div>
                    <input value="{{old('loginEmail')}}" name="password" class="roboto {{$errors->has('password')?'invalid':""}}" type="password" />
                    @if ($errors->has('password'))
                        <p class="error-block">{{ $errors->first('password') }}</p>
                    @endif

                    <div class="label">{{__('client.password_confirmation')}}</div>
                    <input value="{{old('loginEmail')}}" name="password_confirmation" class="roboto {{$errors->has('password_confirmation')?'invalid':""}}" type="password"  />
                    @if ($errors->has('password_confirmation'))
                        <p class="error-block">{{ $errors->first('password_confirmation') }}</p>
                    @endif

                    <button class="lisu_btn">{{__('client.update')}}</button>

                </form>



            </div>
        </div>
    </section>
    <div class="commonPopup subscribe_popup ">
        <div class="commonPopupContainer ">
            <div class="flex center success">
                <img src="/img/icons/tick.png" alt="" />
                <div>Success!</div>
            </div>
            <p>Your password has been successfully reset.</p>
            <div class="flex center btnflex">
                <a href="#">
                    <button>Back To Home Page</button>
                </a>
            </div>
        </div>
    </div>
@endsection
