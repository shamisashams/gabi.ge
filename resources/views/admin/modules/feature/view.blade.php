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
                                                <td>{{trans('admin.title')}}:</td>
                                                <td>{{(count($feature->availableLanguage) > 0) ?  $feature->availableLanguage[0]->title : ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.position')}}:</td>
                                                <td class="users-view-latest-activity">{{$feature->position}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.type')}}:</td>
                                                <td class="users-view-verified">{{$feature->type}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td class="users-view-role">{{$feature->status}}</td>
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
