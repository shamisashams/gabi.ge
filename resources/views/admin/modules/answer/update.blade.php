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
                                        <input name="old-images[]" id="old_images" hidden disabled value="{{$answer->files}}">
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('answerUpdate',[app()->getLocale(),$answer->id])}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('PUT') }}

                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select class="select2 browser-default validate {{$errors->has('feature'?'invalid':'valid')}}" name="feature">
                                                                @foreach($features as $feature)
                                                                    <option
                                                                        value="{{$feature->id}}" {{($answer->feature->feature_id == $feature->id) ? 'selected' : ''}} >{{count($feature->availableLanguage)>0 ? $feature->availableLanguage[0]->title:""}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="feature">{{trans('admin.feature')}}</label>
                                                            @if ($errors->has('feature'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('feature') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="position" type="text"
                                                                   class="validate {{ $errors->has('position') ? 'invalid' : 'valid' }}"
                                                                   value="{{$answer->position}}"
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
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{count($answer->availableLanguage)>0?$answer->availableLanguage[0]->title:""}}"
                                                                   data-error=".errorTxt">
                                                            <label for="title"
                                                                   class="acitve">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12">

                                                    <label>
                                                        <input type="checkbox"
                                                               {{($answer->status == 1) ? 'checked' : ''}} name="status">
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
                                                <div class="input-field col s12">
                                                    <button type="submit" class="btn indigo right">
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
