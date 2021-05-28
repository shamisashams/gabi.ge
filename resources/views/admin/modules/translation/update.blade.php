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
                                              action="{{route('translationUpdate',[app()->getLocale(),$translation->id])}}"
                                              method="POST">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="key" name="key" type="text"
                                                                   class="validate {{ $errors->has('key') ? 'invalid' : 'valid' }}"
                                                                   value="{{$translation->key}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.key')}}</label>
                                                            @if ($errors->has('key'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('key') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="group" name="group" type="text"
                                                                   class="validate {{ $errors->has('group') ? 'invalid' : 'valid' }}"
                                                                   value="{{$translation->group}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.group')}}</label>
                                                            @if ($errors->has('group'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('group') }}</small>
                                                            @endif
                                                        </div>
                                                        @foreach($languages as $language)
                                                            <div class="col s12 input-field">
                                                                <input id="{{$language->abbreviation}}" name="language[{{$language->abbreviation}}]" type="text"
                                                                       class="validate {{ $errors->has('abbreviation') ? 'invalid' : 'valid' }}"
                                                                       value="{{isset($translation->text[$language->abbreviation])?$translation->text[$language->abbreviation]:""}}"
                                                                       data-error=".errorTxt">
                                                                <label for="{{$language->abbreviation}}"
                                                                       class="active">{{$language->abbreviation}}</label>
                                                                @if ($errors->has($language->abbreviation))
                                                                    <small
                                                                        class="errorTxt">{{ $errors->first($language->abbreviation) }}</small>
                                                                @endif
                                                            </div>
                                                        @endforeach

                                                    </div>
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
