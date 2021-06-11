@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <!-- users view start -->
                    <div class="section users-view">
                        <div class="card-panel">
                            <div class="row">
                                <div class="col s12 m7">
                                    <div class="display-flex media">
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <span class="users-view-name">{{trans('admin.page')}}</span>
                                            </h6>
                                            <span>ID:</span>
                                            <span class="users-view-id">{{$page->id}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    <a style="margin-right: 10px" href="{{route('pageEditView',[app()->getLocale(),$page->id])}}" class="btn waves-effect waves-light green darken-1">{{trans('admin.edit')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m4">
                                        <table class="striped">
                                            <tbody>
                                            <tr>
                                                <td>{{trans('admin.id')}}:</td>
                                                <td>{{$page->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.title')}}:</td>
                                                <td class="users-view-latest-activity">{{count($page->availableLanguage)>0?$page->availableLanguage[0]->title:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.description')}}:</td>
                                                <td class="users-view-latest-activity">{{count($page->availableLanguage)>0?$page->availableLanguage[0]->description:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.slug')}}:</td>
                                                <td class="users-view-verified">{{count($page->availableLanguage)>0?$page->availableLanguage[0]->slug:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.meta_title')}}:</td>
                                                <td class="users-view-latest-activity">{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_title:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td class="users-view-verified">{{$page->status}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.content')}}:</td>
                                                <td class="users-view-verified">{!!count($page->availableLanguage)>0?$page->availableLanguage[0]->content:""!!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div style="display: flex;flex-wrap:wrap;">
                                    @if(count($page->files)>0)
                                        @foreach($page->files as $file)
                                            <div class="flex-image">
                                                <img  src="/storage/page/{{$file->fileable_id}}/{{$file->name}}" class="page-image"/>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
