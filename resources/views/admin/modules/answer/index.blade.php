@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    @include('admin.modules.language-tab.tab')
                    <div class="card-content">
                        <a href="{{route('answerCreate',app()->getLocale())}}"
                           class="mb-2 btn waves-effect waves-light green darken-1">{{trans('admin.create_answer')}}</a>
                        <div style="">
                            {!! Form::open(['url' => route('answerIndex',app()->getLocale()),'method' =>'get']) !!}
                            <div style="display: flex;flex-direction: column;margin-bottom:10px; ">
                                <div>
                                    @if ($errors->has('title'))
                                        <span class="error-block">
                                        {{ $errors->first('title') }}
                                         </span>
                                    @endif
                                </div>
                                <div>

                                    @if ($errors->has('position'))
                                        <span class="error-block">
                                                {{ $errors->first('position') }}
                                            </span>
                                    @endif
                                </div>
                                <div>
                                    @if ($errors->has('status'))
                                        <span class="error-block">
                                                {{ $errors->first('status') }}
                                            </span>
                                    @endif
                                </div>
                                <div>
                                    @if ($errors->has('feature'))
                                        <span class="error-block">
                                                {{ $errors->first('feature') }}
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th>{{trans('admin.feature')}}</th>
                                    <th>{{trans('admin.title')}}</th>
                                    <th>{{trans('admin.position')}}</th>
                                    <th>{{trans('admin.status')}}</th>
                                    <th>{{trans('admin.action')}}</th>
                                </tr>
                                <tr>
                                    <th>
                                        <div style="margin-bottom: 9px">
                                            <select class="select2 browser-default" name="feature"
                                                    onchange="this.form.submit()">
                                                <option selected value="">All</option>
                                                @foreach($features as $feature)
                                                    <option
                                                        value="{{$feature->id}}" {{(\Request::get('feature') == $feature->id) ? 'selected' : ''}}>{{count($feature->availableLanguage)>0 ? $feature->availableLanguage[0]->title:""}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        {{ Form::text('title',Request::get('title'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        <br>
                                    </th>
                                    <th>
                                        {{ Form::text('position',Request::get('position'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}

                                    </th>
                                    <th>
                                        {{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                {!! Form::close() !!}
                                <tbody>

                                @if($answers)
                                    @foreach($answers as $answer)
                                        <tr>
                                            <td>{{$answer->feature?(count($answer->feature->feature->availableLanguage)>0?$answer->feature->feature->availableLanguage[0]->title:""):""}}</td>
                                            <td>{{(count($answer->availableLanguage) > 0) ?  $answer->availableLanguage[0]->title : ''}}</td>
                                            <td>{{$answer->position}}</td>
                                            <td>
                                                @if($answer->status)
                                                    <span
                                                        class="chip lighten-5 green green-text">{{trans('admin.active')}}</span>
                                                @else
                                                    <span
                                                        class="chip lighten-5 red red-text">{{trans('admin.not_active')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('answerEdit',[app()->getLocale(),$answer->id])}}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{route('answerShow',[app()->getLocale(),$answer->id])}}"><i
                                                        class="material-icons">remove_red_eye</i></a>
                                                {!! Form::open(['url' => route('answerDestroy',[app()->getLocale(),$answer->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
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
                            {{ $answers->appends(request()->query())->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
