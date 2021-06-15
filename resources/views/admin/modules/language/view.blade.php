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
                                                <span class="users-view-name">{{trans('admin.language')}}</span>
                                            </h6>
                                            <span>ID:</span>
                                            <span class="users-view-id">{{$language->id}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    <a style="margin-right: 10px"
                                       href="{{route('languageEditView',[app()->getLocale(),$language->id])}}"
                                       class="btn waves-effect waves-light green darken-1">{{trans('admin.edit')}}</a>
                                    {!! Form::open(['url' => route('languageDestroy',[app()->getLocale(),$language->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
                                    <a onclick="deleteAlert(this,'Are you sure, you want to delete this item?!');"
                                       type="submit" class="btn waves-effect waves-light red accent-2">
                                        {{trans('admin.delete')}}
                                    </a>
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
                                                <td>{{trans('admin.title')}}:</td>
                                                <td>{{$language->title}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.abbreviation')}}:</td>
                                                <td class="users-view-latest-activity">{{$language->abbreviation}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.native')}}:</td>
                                                <td class="users-view-verified">{{$language->native}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.locale')}}:</td>
                                                <td class="users-view-role">{{$language->locale}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td>
                                                    @if($language->status)
                                                        <span
                                                            class="users-view-status chip green lighten-5 green-text">{{trans('admin.active')}}</span>
                                                    @else
                                                        <span
                                                            class="users-view-status chip red lighten-5 red-text">{{trans('admin.not_active')}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <td>{{trans('admin.default')}}:</td>
                                            <td class="users-view-role">{{$language->default?'True':'False'}}</td>
                                            <tr>

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
