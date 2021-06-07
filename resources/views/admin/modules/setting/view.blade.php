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
