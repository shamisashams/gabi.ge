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
                            <table class="">
                                <thead>
                                <tr>
                                    <th>{{trans('client.id')}}</th>
                                    <th>{{trans('client.title')}}</th>
                                    <th>{{trans('client.abbreviation')}}</th>
                                    <th>{{trans('client.native')}}</th>
                                    <th>{{trans('client.status')}}</th>
                                    <th>{{trans('client.action')}}</th>
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
                                <tr>
                                    <td>Alvin</td>
                                    <td>Eclair</td>
                                    <td>$0.87</td>
                                    <td>$0.87</td>
                                    <td>$0.87</td>
                                    <td><a href="page-users-edit.html"><i class="material-icons">edit</i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
