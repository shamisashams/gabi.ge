@extends('admin.layouts.app')
@section('content')
    <div class="section">

        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    @include('admin.modules.language-tab.tab')
                    <div class="card-content">
                        {{--                        <a href="{{route('translationCreate',app()->getLocale())}}"--}}
                        {{--                           class="mb-4 btn waves-effect waves-light green darken-1">{{trans('admin.create_language')}}</a>--}}
                        <div style="overflow: auto">
                            {!! Form::open(['url' => route('subscriberIndex',app()->getLocale()),'method' =>'get']) !!}
                            <ul>
                                <li>
                                    @if ($errors->has('id'))
                                        <span class="error-block">
                                           {{ $errors->first('id') }}
                                        </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('email'))
                                        <span class="error-block">
                                          {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </li>

                            </ul>
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th>{{trans('admin.id')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.date')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding:0">
                                        {{ Form::text('key',Request::get('key'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::text('group',Request::get('group'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}

                                    </th>
                                    <th>
                                        {{ Form::text('text',Request::get('text'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}

                                <tbody>
                                @if($subscribers)
                                    @foreach($subscribers as $subscriber)
                                        <tr>
                                            <td>{{$subscriber->key}}</td>
                                            <td>{{$subscriber->email}}</td>
                                            <td>{{$subscriber->created_at}}</td>
                                            <td>
                                                {!! Form::open(['url' => route('subscriberDestroy',[app()->getLocale(),$subscriber->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
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
                            {{ $subscribers->appends(request()->query())->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
