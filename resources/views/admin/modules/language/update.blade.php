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
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('languageUpdate',[app()->getLocale(),$language->id])}}"
                                              method="POST">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{$language->title}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="name" name="abbreviation" type="text"
                                                                   class="validate {{ $errors->has('abbreviation') ? 'invalid' : 'valid' }}"
                                                                   value="{{$language->abbreviation}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.abbreviation')}}</label>
                                                            @if ($errors->has('abbreviation'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('abbreviation') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="email" name="native" type="text"
                                                                   class="validate {{ $errors->has('native') ? 'invalid' : 'valid' }}"
                                                                   value="{{$language->native}}"
                                                                   data-error=".errorTxt">
                                                            <label for="email"
                                                                   class="active">{{trans('admin.native')}}</label>
                                                            @if ($errors->has('native'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('native') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="email" name="locale" type="text"
                                                                   class="validate {{ $errors->has('locale') ? 'invalid' : 'valid' }}"
                                                                   value="{{$language->locale}}"
                                                                   data-error=".errorTxt">
                                                            <label for="email"
                                                                   class="active">{{trans('admin.locale')}}</label>
                                                            @if ($errors->has('locale'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('locale') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12">

                                                    <label>
                                                        <input type="checkbox" {{$language->status ? 'checked' : '' }} name="status">
                                                        <span>{{trans('admin.status')}}</span>
                                                    </label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" name="default" {{$language->default ? 'checked' : '' }}>
                                                        <span>{{trans('admin.default')}}</span>
                                                    </label>
                                                </div>
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
