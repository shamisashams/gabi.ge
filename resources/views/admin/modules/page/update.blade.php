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
                                              action="{{route('pageUpdate',[app()->getLocale(),$page->id])}}"
                                              method="POST" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @csrf

                                            <?php
                                            $htags = [
                                                'h1',
                                                'h2',
                                                'h3',
                                                'h4',
                                                'h5',
                                                'h6'
                                            ];
                                            ?>
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select name="h_tag[home]">
                                                                <option value=""></option>
                                                                @foreach($htags as $htag)
                                                                    <option {{$page->h_tag && $page->h_tag->home == $htag ? 'selected':''}}>{{$htag}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label
                                                                class="active">{{trans('admin.title_htag')}}</label>

                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="title" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->title : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="title"
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

                                                        <div class="col s12 input-field">
                                                            <input id="meta_keyword" name="meta_keyword" type="text"
                                                                   class="validate {{ $errors->has('meta_keyword') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->meta_keyword : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="meta_keyword"
                                                                   class="active">{{trans('admin.meta_keyword')}}</label>
                                                            @if ($errors->has('meta_keyword'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_keyword') }}</small>
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
                                                            <input id="meta_description" name="meta_description" type="text"
                                                                   class="validate {{ $errors->has('meta_description') ? 'invalid' : 'valid' }}"
                                                                   value="{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->meta_description : ''}}"
                                                                   data-error=".errorTxt">
                                                            <label for="meta_description"
                                                                   class="active">{{trans('admin.meta_description')}}</label>
                                                            @if ($errors->has('meta_description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_description') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <label for="content">{{trans('admin.content')}}</label>
                                                    <textarea id="content" class="ckeditor form-control"
                                                              name="content">{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->content : ''}}</textarea>
                                                </div>
                                                <div class="col s12">
                                                    <label for="content_2">{{trans('admin.content_2')}}</label>
                                                    <textarea id="content_2" class="ckeditor form-control"
                                                              name="content_2">{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->content_2 : ''}}</textarea>
                                                </div>
                                                <div class="col s12">
                                                    <label for="content_3">{{trans('admin.content_3')}}</label>
                                                    <textarea id="content_3" class="ckeditor form-control"
                                                              name="content_3">{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->content_3 : ''}}</textarea>
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

                                                @if($page->type == 'helps')


                                                <div class="col s6">
                                                    <a class="btn" href="{{route('addHelp')}}">@lang('admin.add_help')</a>
                                                    <table class="striped">
                                                        <tr>
                                                            <th>{{trans('admin.id')}}</th>
                                                            <th>{{trans('admin.title')}}</th>

                                                            <th>{{trans('admin.action')}}</th>

                                                            @foreach($helps as $help)
                                                                <tr>
                                                                    <td>{{$help->id}}</td>
                                                                    <td>
                                                                        {{(count($help->availableLanguage) > 0) ?  $help->availableLanguage[0]->title : ''}}
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('editHelp',[app()->getLocale(),$help])}}">edit</a>
                                                                        <a href="{{route('deleteHelp',[app()->getLocale(),$help])}}">delete</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tr>
                                                    </table>
                                                </div>


                                                    <div class="col s6">
                                                        <a class="btn" href="{{route('addFaq')}}">@lang('admin.add_faq')</a>
                                                        <table class="striped">
                                                            <tr>
                                                                <th>{{trans('admin.id')}}</th>
                                                                <th>{{trans('admin.question')}}</th>

                                                                <th>{{trans('admin.action')}}</th>

                                                            @foreach($faqs as $faq)
                                                                <tr>
                                                                    <td>{{$faq->id}}</td>
                                                                    <td>
                                                                        {{(count($faq->availableLanguage) > 0) ?  $faq->availableLanguage[0]->question : ''}}
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('editFaq',[app()->getLocale(),$faq])}}">edit</a>
                                                                        <a href="{{route('deleteFaq',[app()->getLocale(),$faq])}}">delete</a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                </tr>
                                                        </table>
                                                    </div>

                                                @endif

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
