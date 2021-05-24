@extends('admin.layouts.auth.app')
@section('content')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form class="login-form" action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">{{__('client.sign_in')}}</h5>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="username" type="text" name="email" value="{{old('email')}}">
                                    <label for="username" class="center-align">{{__('client.email')}}</label>
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password" name="password">
                                    <label for="password">{{__('client.password')}}</label>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                    {{ $errors->first('password') }}
                                                </span>
                                    @elseif($errors->has('auth'))
                                        <span class="help-block">
                                              {{ $errors->first('auth') }}
                                          </span>
                                    @endif
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col s12 m12 l12 ml-2 mt-1">--}}
{{--                                    <p>--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox"/>--}}
{{--                                            <span>Remember Me</span>--}}
{{--                                        </label>--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="submit"
                                       class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">{{__('client.login')}}</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin medium-small"><a href="user-register.html">{{__('client.register_now')}}</a></p>
                                </div>
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin right-align medium-small"><a href="user-forgot-password.html">{{__('client.forgot_password')}} ?</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
