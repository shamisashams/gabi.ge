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
                                                <span class="users-view-name">{{trans('admin.sale')}}</span>
                                            </h6>
                                            <span>ID:</span>
                                            <span class="users-view-id">{{$sale->id}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    <a style="margin-right: 10px" href="{{route('saleEditView',[app()->getLocale(),$sale->id])}}" class="btn waves-effect waves-light green darken-1">{{trans('admin.edit')}}</a>
                                    {!! Form::open(['url' => route('saleDestroy',[app()->getLocale(),$sale->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
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
