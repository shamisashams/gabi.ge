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
                                                <td>{{trans('admin.feature')}}:</td>
                                                <td>{{$answer->feature?(count($answer->feature->feature->availableLanguage)>0?$answer->feature->feature->availableLanguage[0]->title:""):""}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.title')}}:</td>
                                                <td class="users-view-latest-activity">{{(count($answer->availableLanguage) > 0) ?  $answer->availableLanguage[0]->title : ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.position')}}:</td>
                                                <td class="users-view-verified">{{$answer->position}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td>
                                                    @if($answer->status)
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
                                    @if(count($answer->files)>0)
                                        @foreach($answer->files as $file)
                                            <div class="flex-image">
                                                <img  src="/storage/answer/{{$file->fileable_id}}/{{$file->name}}" class="page-image"/>
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
