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
                                        <input name="old-images[]" id="old_images" hidden disabled
                                               value="{{$page->files}}">
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('saleUpdate',[app()->getLocale(),$page->id])}}"
                                              method="POST" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->title : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="meta_title" type="text"
                                                                   class="validate {{ $errors->has('meta_title') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->meta_title : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.meta_title')}}</label>
                                                            @if ($errors->has('meta_title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_title') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="slug" type="text"
                                                                   class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->slug : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.slug')}}</label>
                                                            @if ($errors->has('slug'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('slug') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="description" name="description" type="text"
                                                                   class="validate {{ $errors->has('description') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->description : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="description"
                                                                   class="active">{{trans('admin.description')}}</label>
                                                            @if ($errors->has('description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('description') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <label for="content">{{trans('admin.content')}}</label>
                                                    <textarea id="content" class="ckeditor form-control"
                                                              name="content">{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->content : ''}}</textarea>
                                                </div>
                                                <div class="col s12 m6" style="margin-top:20px">
                                                    <div class="input-images"></div>
                                                    @if ($errors->has('images'))
                                                        <span class="help-block">
                                                         {{ $errors->first('images') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col s12" style="margin-top:10px">
                                                    <label>
                                                        <input type="checkbox"
                                                               {{$page->status ? 'checked' : '' }} name="status">
                                                        <span>{{trans('admin.status')}}</span>
                                                    </label>
                                                </div>
                                                <div class="input-field col s12">
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

    <script src="{{asset('../admin/ckeditor/ckeditor.js')}}"></script>
@endsection
