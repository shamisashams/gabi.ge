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
                                                <td>{{$sale->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.title')}}:</td>
                                                <td class="users-view-latest-activity">{{count($sale->availableLanguage)>0?$sale->availableLanguage[0]->title:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.discount')}}:</td>
                                                <td class="users-view-latest-activity">{{$sale->discount}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.type')}}:</td>
                                                <td class="users-view-verified">{{$sale->type}}</td>
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
