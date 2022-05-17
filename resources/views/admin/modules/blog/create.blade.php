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
                                              action="{{route('blogStore',app()->getLocale())}}" method="POST"
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
                                                            <input id="title" name="title_2" type="text"
                                                                   class="validate {{ $errors->has('title_2') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('title_2')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="title"
                                                                   class="active">{{trans('admin.title_2')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title_2') }}</small>
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








                                                        <div class="col s12 input-field">
                                                            <input id="meta_description" name="meta_description"
                                                                   type="text"
                                                                   class="validate {{ $errors->has('meta_description') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('meta_description')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="meta_description"
                                                                   class="active">{{trans('admin.meta_description')}}</label>
                                                            @if ($errors->has('meta_description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_description') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="meta_keywords" name="meta_keywords" type="text"
                                                                   class="validate {{ $errors->has('meta_keywords') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('meta_keywords')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="meta_keywords"
                                                                   class="active">{{trans('admin.meta_keywords')}}</label>
                                                            @if ($errors->has('meta_keywords'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_keywords') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12">

                                                            <label>
                                                                <input type="checkbox" name="status">
                                                                <span>{{trans('admin.status')}}</span>
                                                            </label>


                                                        </div>

                                                    </div>


                                                </div>
                                                <div class="col s12 m12">
                                                    <div class="row" id="feature-row">
                                                        <div class="col s12">
                                                            <label for="text">{{trans('admin.text_top')}}</label>
                                                            <textarea id="text" class="ckeditor form-control"
                                                                      name="text"></textarea>
                                                            @if ($errors->has('text'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('text') }}</small>
                                                            @endif
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="col s12 m12">
                                                    <div class="row" id="feature-row">
                                                        <div class="col s12">
                                                            <label for="text_2">{{trans('admin.text_middle')}}</label>
                                                            <textarea id="text_2" class="ckeditor form-control"
                                                                      name="text_2"></textarea>
                                                            @if ($errors->has('text_2'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('text_2') }}</small>
                                                            @endif
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="col s12 m12">
                                                    <div class="row" id="feature-row">
                                                        <div class="col s12">
                                                            <label for="text_3">{{trans('admin.text_bottom')}}</label>
                                                            <textarea id="text_3" class="ckeditor form-control"
                                                                      name="text_3"></textarea>
                                                            @if ($errors->has('text_3'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('text_3') }}</small>
                                                            @endif
                                                        </div>


                                                    </div>
                                                </div>


                                                <div class="col s12 m12" style="margin-top:20px">
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
