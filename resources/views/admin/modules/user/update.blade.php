@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <!-- users edit start -->
                    <div class="section users-edit">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 active" id="account">
                                        <input name="old-images[]" id="old_images" hidden disabled value="{{$user->files}}">
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('userUpdate',[app()->getLocale(),$user->id])}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
{{--                                                        <div class="col s12 input-field">--}}
{{--                                                            <input id="abbreviation" name="name" type="text"--}}
{{--                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"--}}
{{--                                                                   value="{{$user->name}}"--}}
{{--                                                                   data-error=".errorTxt">--}}
{{--                                                            <label for="username"--}}
{{--                                                                   class="active">{{trans('admin.name')}}</label>--}}
{{--                                                            @if ($errors->has('name'))--}}
{{--                                                                <small--}}
{{--                                                                    class="errorTxt">{{ $errors->first('name') }}</small>--}}
{{--                                                            @endif--}}

{{--                                                        </div>--}}
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="password" type="password"
                                                                   class="validate {{ $errors->has('password') ? 'invalid' : 'valid' }}"
                                                                   value=""
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.password')}}</label>
                                                            @if ($errors->has('password'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('password') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="email" type="text"
                                                                   class="validate {{ $errors->has('email') ? 'invalid' : 'valid' }}"
                                                                   value="{{$user->email}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.email')}}</label>
                                                            @if ($errors->has('email'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('email') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="first_name" type="text"
                                                                   class="validate {{ $errors->has('first_name') ? 'invalid' : 'valid' }}"
                                                                   value="{{$user->profile->first_name}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.first_name')}}</label>
                                                            @if ($errors->has('first_name'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('first_name') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="last_name" type="text"
                                                                   class="validate {{ $errors->has('last_name') ? 'invalid' : 'valid' }}"
                                                                   value="{{$user->profile->last_name}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.last_name')}}</label>
                                                            @if ($errors->has('last_name'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('last_name') }}</small>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="phone" type="text"
                                                                   class="validate {{ $errors->has('phone') ? 'invalid' : 'valid' }}"
                                                                   value="{{$user->profile->phone}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.phone')}}</label>
                                                            @if ($errors->has('phone'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('phone') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="address" type="text"
                                                                   class="validate {{ $errors->has('address') ? 'invalid' : 'valid' }}"
                                                                   value="{{$user->profile->address}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.address')}}</label>
                                                            @if ($errors->has('address'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('address') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="city" type="text"
                                                                   class="validate {{ $errors->has('city') ? 'invalid' : 'valid' }}"
                                                                   value="{{$user->profile->city}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.city')}}</label>
                                                            @if ($errors->has('city'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('city') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="country" type="text"
                                                                   class="validate {{ $errors->has('country') ? 'invalid' : 'valid' }}"
                                                                   value="{{$user->profile->country}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.country')}}</label>
                                                            @if ($errors->has('country'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('country') }}</small>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12">

                                                    <label>
                                                        <input type="checkbox" {{$user->status?"checked":""}} name="status">
                                                        <span>{{trans('admin.status')}}</span>
                                                    </label>
                                                </div>
{{--                                                <div class="col s12 m6" style="margin-top:20px">--}}
{{--                                                    <div class="input-images"></div>--}}
{{--                                                    @if ($errors->has('images'))--}}
{{--                                                        <span class="help-block">--}}
{{--                                                         {{ $errors->first('images') }}--}}
{{--                                                        </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn indigo">
                                                        {{trans('admin.update')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
