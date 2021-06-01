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
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('featureCreate',app()->getLocale())}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('title')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="position" type="text"
                                                                   class="validate {{ $errors->has('position') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('position')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.position')}}</label>
                                                            @if ($errors->has('position'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('position') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <select name="type">
                                                                <option value="" disabled selected>Choose your option
                                                                </option>
                                                                <option {{old('type')=='input'?"selected":""}} value="input">Input</option>
                                                                <option {{old('type')=="textarea"?"selected":""}} value="textarea">Text Area</option>
                                                                <option {{old('type')=="checkbox"?"selected":""}} value="checkbox">Checkbox</option>
                                                                <option {{old('type')=="radio"?"selected":""}} value="radio">Radio</option>
                                                                <option {{old('type')=="select"?"selected":""}} value="select">Select</option>
                                                            </select>
                                                            <label for="type" class="">{{trans('admin.type')}}</label>
                                                            @if ($errors->has('type'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('type') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12">

                                                    <label>
                                                        <input type="checkbox" name="status">
                                                        <span>{{trans('admin.status')}}</span>
                                                    </label>
                                                </div>
                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn indigo">
                                                        {{trans('admin.create')}}
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
