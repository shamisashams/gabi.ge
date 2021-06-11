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
                                                <span class="users-view-name">{{trans('admin.setting')}}</span>
                                            </h6>
                                            <span>ID:</span>
                                            <span class="users-view-id">{{$setting->id}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    <a style="margin-right: 10px" href="{{route('settingEditView',[app()->getLocale(),$setting->id])}}" class="btn waves-effect waves-light green darken-1">{{trans('admin.edit')}}</a>
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
                                                <td>{{$setting->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.key')}}:</td>
                                                <td class="users-view-latest-activity">{{$setting->key}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.value')}}:</td>
                                                <td class="users-view-verified">{{(count($setting->availableLanguage) > 0) ?  $setting->availableLanguage[0]->value : ''}}</td>
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
