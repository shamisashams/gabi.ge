@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <!-- users view start -->
                    <div class="section users-view">
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
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
