@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <!-- users edit start -->
                    <div class="section users-edit">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 active" id="account">
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('saleUpdate',[app()->getLocale(),$sale->id])}}"
                                              method="POST">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{count($sale->availableLanguage)>0?$sale->availableLanguage[0]->title:""}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="discount" type="number"
                                                                   class="validate {{ $errors->has('discount') ? 'invalid' : 'valid' }}"
                                                                   value="{{$sale->discount}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.discount')}}</label>
                                                            @if ($errors->has('discount'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('discount') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <select name="type">
                                                                <option value="" disabled
                                                                        selected>{{trans('admin.choose_type')}}
                                                                </option>
                                                                <option
                                                                    {{$sale->type==\App\Models\Sale::TYPE_PERCENT?"selected":""}} value="{{\App\Models\Sale::TYPE_PERCENT}}">{{trans('admin.percent')}}</option>
                                                                <option
                                                                    {{$sale->type===App\Models\Sale::TYPE_FIXED?"selected":""}} value="{{\App\Models\Sale::TYPE_FIXED}}">{{trans('admin.fixed')}}</option>
                                                            </select>
                                                            <label for="type" class="">{{trans('admin.type')}}</label>
                                                            @if ($errors->has('type'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('type') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="col s12">--}}

                                                {{--                                                    <label>--}}
                                                {{--                                                        <input type="checkbox" name="status">--}}
                                                {{--                                                        <span>{{trans('admin.status')}}</span>--}}
                                                {{--                                                    </label>--}}
                                                {{--                                                </div>--}}
                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn indigo">
                                                        {{trans('admin.update')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
