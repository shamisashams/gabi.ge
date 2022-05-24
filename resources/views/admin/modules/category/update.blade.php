@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <?php
        ?>
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
                                        <input name="old-images[]" id="old_images" hidden disabled
                                               value="{{$categoryItem->files}}">
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('categoryUpdate',[app()->getLocale(),$categoryItem->id])}}"
                                              method="POST" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="title" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->title : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="id"
                                                                   class="active">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif

                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="meta_title" name="meta_title" type="text"
                                                                   class="validate {{ $errors->has('meta_title') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->meta_title : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="id"
                                                                   class="active">{{trans('admin.meta_title')}}</label>
                                                            @if ($errors->has('meta_title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_title') }}</small>
                                                            @endif

                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="meta_keyword" name="meta_keyword" type="text"
                                                                   class="validate {{ $errors->has('meta_keyword') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->meta_keyword : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="id"
                                                                   class="active">{{trans('admin.meta_keyword')}}</label>
                                                            @if ($errors->has('meta_keyword'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_keyword') }}</small>
                                                            @endif

                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="slug" name="slug" type="text"
                                                                   class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->slug : ''}}"
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
                                                                   class="validate {{ $errors->has('description') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->description : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="description"
                                                                   class="active">{{trans('admin.description')}}</label>
                                                            @if ($errors->has('description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('description') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="meta_description" name="meta_description" type="text"
                                                                   class="validate {{ $errors->has('meta_description') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->meta_description : ''}}"
                                                                      data-error=".errorTxt">
                                                            <label for="meta_description"
                                                                   class="active">{{trans('admin.meta_description')}}</label>
                                                            @if ($errors->has('meta_description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_description') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="position" name="position" type="number"
                                                                   class="validate {{ $errors->has('position') ? 'invalid' : 'valid' }}"
                                                                   value="{{$categoryItem->position}}"
                                                                   data-error=".errorTxt">
                                                            <label for="description"
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
                                                        <input type="checkbox"
                                                               {{$categoryItem->status ? 'checked' : '' }} name="status">
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
