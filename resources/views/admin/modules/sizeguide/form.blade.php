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
                                        {!! Form::model($item,['url' => $action, 'method' => $method, 'novalidate' => 'novalidate', 'id' => 'accountForm']) !!}

                                        {{-- @dd($item->language) --}}
                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">


                                                        <div class="col s12 input-field">

                                                            <select name="gender" class="select2 browser-default">
                                                                <option value="" disabled selected>gender</option>
                                                                {{-- {{old('gender') ==  0   ?   "selected":""}} value="{{$sale->id}}">{{(count($sale->availableLanguage) > 0) ?  $sale->availableLanguage[0]->title : ''}}</option> --}}
                                                                <option {{old('gender') ==  0   ?   "selected":""}} value=false>boy</option>
                                                                <option {{old('gender') ==  1   ?   "selected":""}} value=true>girl</option>
                                                            </select>
                                                            <label for="gender" class="">{{trans('admin.gender')}}</label>
                                                            @if ($errors->has('gender'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('gender') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="age" type="text"
                                                                   class="validate {{ $errors->has('age') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->language && isset($item->language[0]->age) != []? $item->language[0]->age : old('age')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.age')}}</label>
                                                            @if ($errors->has('age'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('age') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="chest" type="text"
                                                                   class="validate {{ $errors->has('chest') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->chest !== '' ? $item->chest : old('chest')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.chest')}}</label>
                                                            @if ($errors->has('chest'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('chest') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="wheist" type="text"
                                                                   class="validate {{ $errors->has('wheist') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->wheist !== '' ? $item->wheist : old('wheist')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.wheist')}}</label>
                                                            @if ($errors->has('wheist'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('wheist') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="hips" type="text"
                                                                   class="validate {{ $errors->has('hips') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->hips !== '' ? $item->hips : old('hips')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.hips')}}</label>
                                                            @if ($errors->has('hips'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('hips') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="back" type="text"
                                                                   class="validate {{ $errors->has('back') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->back !== '' ? $item->back : old('back')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.back')}}</label>
                                                            @if ($errors->has('back'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('back') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="arm" type="text"
                                                                   class="validate {{ $errors->has('arm') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->arm !== '' ? $item->arm : old('arm')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.arm')}}</label>
                                                            @if ($errors->has('arm'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('arm') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="leg" type="text"
                                                                   class="validate {{ $errors->has('leg') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->leg !== '' ? $item->leg : old('leg')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.leg')}}</label>
                                                            @if ($errors->has('leg'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('leg') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="abbreviation" name="shoulder" type="text"
                                                                   class="validate {{ $errors->has('shoulder') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->shoulder !== '' ? $item->shoulder : old('shoulder')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="name"
                                                                   class="active">{{trans('admin.shoulder')}}</label>
                                                            @if ($errors->has('shoulder'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('shoulder') }}</small>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn indigo">
                                                        @if($item->created_at){{trans('admin.update')}}@else{{trans('admin.create')}}@endif
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
