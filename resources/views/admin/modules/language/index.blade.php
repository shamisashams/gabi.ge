@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Languages</h4>
                        <div>
                            {!! Form::open(['url' => route('adminHome',app()->getLocale()),'method' =>'get']) !!}
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
                                        @if ($errors->has('id'))
                                            <span class="help-block">
                            {{ $errors->first('id') }}
                            </span>
                                        @endif
                                    </th>
                                    <th>
                                        {{ Form::text('title',Request::get('title'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                            {{ $errors->first('title') }}
                            </span>
                                        @endif
                                    </th>
                                    <th>
                                        {{ Form::text('abbreviation',Request::get('abbreviation'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('abbreviation'))
                                            <span class="help-block">
                            {{ $errors->first('abbreviation') }}
                            </span>
                                        @endif
                                    </th>
                                    <th>
                                        {{ Form::text('native',Request::get('native'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('native'))
                                            <span class="help-block">
                            {{ $errors->first('native') }}
                            </span>
                                        @endif
                                    </th>
                                    <th>
                                        {{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('status'))
                                            <span class="help-block">
                            {{ $errors->first('status') }}
                            </span>
                                        @endif
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
                                                    <span class="text-green">Active</span>
                                                @else
                                                    <span class="text-red">Not Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('languageEditView',[app()->getLocale(),$language->id])}}"><i
                                                        class="material-icons">edit</i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
