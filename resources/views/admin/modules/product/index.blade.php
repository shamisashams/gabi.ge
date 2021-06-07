@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    @include('admin.modules.language-tab.tab')
                    <div class="card-content">
                        <a href="{{route('translationCreate',app()->getLocale())}}"
                           class="mb-4 btn waves-effect waves-light green darken-1">{{trans('admin.create_product')}}</a>
                        <div>
                            {!! Form::open(['url' => route('translationIndex',app()->getLocale()),'method' =>'get']) !!}
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th>{{trans('admin.key')}}</th>
                                    <th>{{trans('admin.group')}}</th>
                                    <th>{{trans('admin.text')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding:0">
                                        {{ Form::text('key',Request::get('key'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('key'))
                                            <span class="help-block">
                            {{ $errors->first('key') }}
                            </span>
                                        @endif
                                    </th>
                                    <th>
                                        {{ Form::text('group',Request::get('group'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('group'))
                                            <span class="help-block">
                            {{ $errors->first('group') }}
                            </span>
                                        @endif
                                    </th>
                                    <th>
                                        {{ Form::text('text',Request::get('text'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('text'))
                                            <span class="help-block">
                            {{ $errors->first('text') }}
                            </span>
                                        @endif
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}

                                <tbody>
                                @if(isset($translations))
                                    @foreach($translations as $translation)
                                        <tr>
                                            <td>{{$translation->key}}</td>
                                            <td>{{$translation->group}}</td>
                                            <td>
                                                @if($languages)
                                                    <ul class="tabs mb-2 row">
                                                        @foreach($languages as $key=>$language)
                                                            <li class="tab">
                                                                <a onclick="ch"
                                                                   class="display-flex align-items-center {{$key==0?'active':""}}"
                                                                   id="account-tab"
                                                                   href=""><span>{{$language->abbreviation}}</span>
                                                                </a>
                                                            </li>
                                                            <li class="indicator" style="left: 0px; right: 752px;"></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                <div>
                                                    opij
                                                </div>
                                                {{--                                            <td>{{$translation->text[app()->getLocale()]}}</td>--}}
                                                {{--                                            <td>{!! $translation->text!!}</td>--}}
                                            </td>
                                            <td>
                                                <a href="{{route('translationEdit',[app()->getLocale(),$translation->id])}}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{route('translationShow',[app()->getLocale(),$translation->id])}}"><i
                                                        class="material-icons">remove_red_eye</i></a>
                                                {!! Form::open(['url' => route('translationDestroy',[app()->getLocale(),$translation->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
