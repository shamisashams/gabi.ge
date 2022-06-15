@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    {{--@include('admin.modules.language-tab.tab')--}}
                    <div class="card-content">
{{--                        <a href="{{route('featureCreateView',app()->getLocale())}}"--}}
{{--                           class="mb-2 btn waves-effect waves-light green darken-1">{{trans('admin.create_setting')}}</a>--}}
                        <div style="overflow: auto">
                            {!! Form::open(['url' => route('settingIndex',app()->getLocale()),'method' =>'get']) !!}
                            <ul>
                                <li>
                                    @if ($errors->has('id'))
                                        <span class="error-block">
                                                {{ $errors->first('id') }}
                                            </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('key'))
                                        <span class="error-block">
                                                {{ $errors->first('key') }}
                                            </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('value'))
                                        <span class="error-block">
                                                {{ $errors->first('value') }}
                                            </span>
                                    @endif
                                </li>
                            </ul>
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th>{{trans('admin.id')}}</th>
                                    <th>{{trans('admin.key')}}</th>
                                    <th>{{trans('admin.value')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding:0">
                                        {{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::text('key',Request::get('key'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::text('value',Request::get('value'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}
                                <tbody>
                                @if($settings)
                                    @foreach($settings as $setting)
                                        <tr>
                                            <td>{{$setting->id}}</td>
                                            <td>{{$setting->key}}</td>
                                           {{-- <td>{{$setting->value}}</td>--}}
                                            <td>
                                                <a href="{{route('hTagEditView',[app()->getLocale(),$setting->id])}}"><i
                                                        class="material-icons">edit</i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{ $settings->appends(request()->query())->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
