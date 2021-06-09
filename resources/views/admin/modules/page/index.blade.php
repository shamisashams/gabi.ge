@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    @include('admin.modules.language-tab.tab')
                    <div class="card-content">
                        <div style="overflow: auto">
                            {!! Form::open(['url' => route('pageIndex',app()->getLocale()),'method' =>'get']) !!}
                            <ul>
                                <li>
                                    @if ($errors->has('id'))
                                        <span class="error-block">
                                                {{ $errors->first('id') }}
                                            </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('title'))
                                        <span class="error-block">
                                                {{ $errors->first('title') }}
                                            </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('status'))
                                        <span class="error-block">
                                                {{ $errors->first('status') }}
                                            </span>
                                    @endif
                                </li>
                            </ul>
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th>{{trans('admin.id')}}</th>
                                    <th>{{trans('admin.title')}}</th>
                                    <th>{{trans('admin.slug')}}</th>
                                    <th>{{trans('admin.status')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding:0">
                                        {{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::text('title',Request::get('title'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::text('slug',Request::get('slug'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}
                                <tbody>
                                @if($pages)
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>{{$page->id}}</td>
                                            <td>{{count($page->availableLanguage)>0?$page->availableLanguage[0]->title:""}}</td>
                                            <td>{{count($page->availableLanguage)>0?$page->availableLanguage[0]->slug:""}}</td>
                                            <td>
                                                @if($page->status)
                                                    <span
                                                        class="chip lighten-5 green green-text">{{trans('admin.active')}}</span>
                                                @else
                                                    <span
                                                        class="chip lighten-5 red red-text">{{trans('admin.not_active')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('pageEditView',[app()->getLocale(),$page->id])}}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{route('pageShow',[app()->getLocale(),$page->id])}}"><i
                                                        class="material-icons">remove_red_eye</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{ $pages->appends(request()->query())->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
