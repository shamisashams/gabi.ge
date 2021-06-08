@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    @include('admin.modules.language-tab.tab')
                    <div class="card-content">
                        <a href="{{route('saleCreateView',app()->getLocale())}}"
                           class="mb-2 btn waves-effect waves-light green darken-1">{{trans('admin.create_sale')}}</a>
                        <div style="overflow: auto">
                            {!! Form::open(['url' => route('saleIndex',app()->getLocale()),'method' =>'get']) !!}
                            <ul>
                                <li>
                                    @if ($errors->has('id'))
                                        <span class="error-block">
                                                {{ $errors->first('id') }}
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
                            </ul>
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th>{{trans('admin.id')}}</th>
                                    <th>{{trans('admin.discount')}}</th>
                                    <th>{{trans('admin.product')}}</th>
                                </tr>
                                <tr>
                                    <th style="padding:0">
                                        {{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th>
                                        {{ Form::text('discount',Request::get('discount'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
{{--                                    </th>--}}
{{--                                    <th>--}}
{{--                                        {{ Form::text('slug',Request::get('slug'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}--}}
{{--                                    </th>--}}
{{--                                    <th>--}}
{{--                                        {{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}--}}
{{--                                    </th>--}}
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}
                                <tbody>
                                @if($sales)
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td>{{$sale->id}}</td>
                                            <td>{{$sale->discount}}</td>
                                            <td>{{count($sale->product->avaialbeLanguage)>0?$sale->product->avaialbeLanguage[0]->title:""}}</td>
                                            <td>
                                                <a href="{{route('saleEditView',[app()->getLocale(),$sale->id])}}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{route('saleShow',[app()->getLocale(),$sale->id])}}"><i
                                                        class="material-icons">remove_red_eye</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{ $sales->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
