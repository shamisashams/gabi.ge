@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    @include('admin.layouts.alert.alert')
                    <div class="card-content">
                        <a href="{{route('featureCreateView',app()->getLocale())}}"
                           class="mb-4 btn waves-effect waves-light green darken-1">{{trans('admin.create_feature')}}</a>
                        <div style="overflow: auto">
                            {!! Form::open(['url' => route('featureIndex',app()->getLocale()),'method' =>'get']) !!}
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
                                        <select class="select2 browser-default">
                                            <option value="square">Square</option>
                                            <option value="rectangle">Rectangle</option>
                                            <option value="rombo">Rombo</option>
                                            <option value="romboid">Romboid</option>
                                            <option value="trapeze">Trapeze</option>
                                            <option value="traible">Triangle</option>
                                            <option value="polygon">Polygon</option>
                                        </select>                                    @if ($errors->has('feature'))
                                            <span class="help-block">
                                                {{ $errors->first('feature') }}
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
                                        {{ Form::text('position',Request::get('position'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                                        @if ($errors->has('position'))
                                            <span class="help-block">
                                                {{ $errors->first('position') }}
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

                                @if($answers)
                                    @foreach($answers as $answer)
                                        <tr>
                                            <td>{{$answer->feature?(count($answer->feature->availableLanguage)?$answer->feature->availableLanguage[0]->title:""):""}}</td>
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
                            {{ $answers->links('admin.vendor.pagination.custom') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
