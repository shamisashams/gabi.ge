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
                                                <span class="users-view-name">{{trans('admin.slider')}}</span>
                                            </h6>
                                            <span>ID:</span>
                                            <span class="users-view-id">{{$slider->id}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    <a style="margin-right: 10px"
                                       href="{{route('sliderEditView',[app()->getLocale(),$slider->id])}}"
                                       class="btn waves-effect waves-light green darken-1">{{trans('admin.edit')}}</a>
                                    {!! Form::open(['url' => route('sliderDestroy',[app()->getLocale(),$slider->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
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
                                                <td>{{count($slider->availableLanguage)>0?$slider->availableLanguage[0]->title:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.description')}}:</td>
                                                <td class="users-view-latest-activity">{{count($slider->availableLanguage)>0?$slider->availableLanguage[0]->description:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.slug')}}:</td>
                                                <td class="users-view-latest-activity">{{count($slider->availableLanguage)>0?$slider->availableLanguage[0]->slug:""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.position')}}:</td>
                                                <td class="users-view-verified">{{$slider->position}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td class="users-view-verified">{{$slider->status}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td>
                                                    @if($slider->status)
                                                        <span
                                                            class="users-view-status chip green lighten-5 green-text">{{trans('admin.active')}}</span>
                                                    @else
                                                        <span
                                                            class="users-view-status chip red lighten-5 red-text">{{trans('admin.not_active')}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div style="display: flex;flex-wrap:wrap;">
                                    @if(count($slider->files)>0)
                                        @foreach($slider->files as $file)
                                            <div class="flex-image">
                                                <img src="/storage/slider/{{$file->fileable_id}}/{{$file->name}}"
                                                     class="page-image"/>
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
