@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    @include('admin.modules.language-tab.tab')
                    <div class="card-content">
{{--                        <a href="{{route('orderCreateView',app()->getLocale())}}"--}}
{{--                           class="mb-2 btn waves-effect waves-light green darken-1">{{trans('admin.create_order')}}</a>--}}
{{--                        <div style="overflow: auto">--}}
                            {!! Form::open(['url' => route('orderIndex',app()->getLocale()),'method' =>'get']) !!}
                            <ul>
                                <li>
                                    @if ($errors->has('id'))
                                        <span class="error-block">
                                                {{ $errors->first('id') }}
                                            </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('name'))
                                        <span class="error-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('discount'))
                                        <span class="error-block">
                                                {{ $errors->first('discount') }}
                                            </span>
                                    @endif
                                </li>
                                <li>
                                    @if ($errors->has('type'))
                                        <span class="error-block">
                                                {{ $errors->first('type') }}
                                            </span>
                                    @endif
                                </li>
                            </ul>
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th>{{trans('admin.id')}}</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.status')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding:0">
                                        {{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::text('total_price',Request::get('total_price'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}

                                    </th>
                                    <th>
                                        {{ Form::text('email',Request::get('email'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::select('status',['' => 'All','1' => 'Active','2' => 'Not Active', "3" => 'Pending'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}
                                <tbody>
                                @if($orders)
                                    @foreach($orders as $order)
{{--                                        @dd($user)--}}
                                        <tr>
{{--                                            @dd($user->products[0]->product)--}}
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->total_price}}</td>
                                            <td>{{$order->email}}</td>
                                            <td>
                                                @if($order->status===1)
                                                    <span
                                                        class="chip lighten-5 green green-text">{{trans('admin.sucess')}}</span>
                                                @elseif($order->status===2)
                                                    <span
                                                        class="chip lighten-5 red red-text">{{trans('admin.fail')}}</span>
                                                @elseif($order->status===3)
                                                    <span
                                                        class="chip lighten-5 yellow orange-text">{{trans('admin.panding')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('orderEditView',[app()->getLocale(),$order->id])}}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{route('orderShow',[app()->getLocale(),$order->id])}}"><i
                                                        class="material-icons">remove_red_eye</i></a>
                                                {!! Form::open(['url' => route('orderDestroy',[app()->getLocale(),$order->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
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
                            {{ $orders->appends(request()->query())->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
