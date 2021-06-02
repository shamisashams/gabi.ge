@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    <div class="card-content">
                        <a href="{{route('languageCreateView',app()->getLocale())}}"
                           class="mb-1 btn waves-effect waves-light green darken-1">{{trans('admin.create_language')}}</a>
                        <div style="overflow: auto">
                            {!! Form::open(['url' => route('languageIndex',app()->getLocale()),'method' =>'get']) !!}
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
                                    @if ($errors->has('abbreviation'))
                                        <span class="error-block">
                                         {{ $errors->first('abbreviation') }}
                                        </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('native'))
                                        <span class="error-block">
                                         {{ $errors->first('native') }}
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
                                    <th>{{trans('admin.abbreviation')}}</th>
                                    <th>{{trans('admin.native')}}</th>
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
                                        {{ Form::text('abbreviation',Request::get('abbreviation'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}

                                    </th>
                                    <th>
                                        {{ Form::text('native',Request::get('native'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}

                                <tbody>
                                @if($languages)
                                    @foreach($languages as $language)
                                        <tr>
                                            <td>{{$language->id}}</td>
                                            <td>{{$language->title}}</td>
                                            <td>{{$language->abbreviation}}</td>
                                            <td>{{$language->native}}</td>
                                            <td>
                                                @if($language->status)
                                                    <span
                                                        class="chip lighten-5 green green-text">{{trans('admin.active')}}</span>
                                                @else
                                                    <span
                                                        class="chip lighten-5 red red-text">{{trans('admin.not_active')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('languageEditView',[app()->getLocale(),$language->id])}}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{route('languageShow',[app()->getLocale(),$language->id])}}"><i
                                                        class="material-icons">remove_red_eye</i></a>
                                                {!! Form::open(['url' => route('languageDestroy',[app()->getLocale(),$language->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
                                                <a onclick="deleteAlert(this,'Are you sure, you want to delete this item?!');"
                                                   type="submit">
                                                    <i class="material-icons dp48">delete</i>
                                                </a>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{ $languages->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
