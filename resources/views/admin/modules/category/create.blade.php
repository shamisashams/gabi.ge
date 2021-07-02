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
                                              action="{{route('categoryCreate',app()->getLocale())}}" method="POST"
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
                                                            <input id="slug" name="slug" type="text"
                                                                   class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('slug')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="slug"
                                                                   class="active">{{trans('admin.slug')}}</label>
                                                            @if ($errors->has('slug'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('slug') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="description" name="description" type="text"
                                                                   class="validate {{ $errors->has('native') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('description')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="description"
                                                                   class="active">{{trans('admin.description')}}</label>
                                                            @if ($errors->has('description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('description') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="position" name="position" type="number"
                                                                   class="validate {{ $errors->has('position') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('position')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="position"
                                                                   class="active">{{trans('admin.position')}}</label>
                                                            @if ($errors->has('position'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('position') }}</small>
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
@endsection
