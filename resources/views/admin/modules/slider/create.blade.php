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
                                              action="{{route('sliderCreate',app()->getLocale())}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="title" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('title')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="title"
                                                                   class="active">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <label for="description"
                                                                   class="active">{{trans('admin.description')}}</label>
                                                            <textarea id="description" name="description" type="text"
                                                                   class="ckeditor validate {{ $errors->has('description') ? 'invalid' : 'valid' }}"
                                                                      data-error=".errorTxt">{{old('description')}}</textarea>

                                                            @if ($errors->has('description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('description') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="redirect_url" type="text"
                                                                   class="validate {{ $errors->has('redirect_url') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('redirect_url')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.redirect_url')}}</label>
                                                            @if ($errors->has('redirect_url'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('redirect_url') }}</small>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="position" type="text"
                                                                   class="validate {{ $errors->has('position') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('position')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.position')}}</label>
                                                            @if ($errors->has('position'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('position') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="slug" type="text"
                                                                   class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('slug')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.slug')}}</label>
                                                            @if ($errors->has('slug'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('slug') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <select name="type">
                                                                <option value="" disabled
                                                                        selected>{{trans('admin.choose_type')}}
                                                                </option>
                                                                <option {{old('type')=="slider"?"selected":""}} value="slider">Slider</option>
                                                                <option {{old('type')=="banner"?"selected":""}} value="banner">Banner</option>
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
                                                <div class="col s12 m6" style="margin-top:20px">
                                                    <div class="input-images"></div>
                                                    @if ($errors->has('images'))
                                                        <span class="help-block">
                                                         {{ $errors->first('images') }}
                                                        </span>
                                                    @endif
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
    <script src="{{asset('../admin/ckeditor/ckeditor.js')}}"></script>
@endsection
