@extends('admin.layouts.app')

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            {!! Form::model($help,['url' => $action, 'method' => $method]) !!}
                                @csrf

                            <?php
                            $htags = [
                                'h1',
                                'h2',
                                'h3',
                                'h4',
                                'h5',
                                'h6'
                            ];
                            ?>

                            <div class="col s12 input-field">
                                <select name="h_tag[home]">
                                    <option value=""></option>
                                    @foreach($htags as $htag)
                                        <option {{$help->h_tag && $help->h_tag->home == $htag ? 'selected':''}}>{{$htag}}</option>
                                    @endforeach
                                </select>
                                <label
                                    class="active">{{trans('admin.title_htag')}}</label>

                            </div>

                                <div class="col s12 input-field">
                                    <input type="text" name="question" value="{{(count($help->availableLanguage) > 0) ?  $help->availableLanguage[0]->question : ''}}">
                                    <label
                                        class="active">{{trans('admin.question')}}</label>
                                    @if ($errors->has('question'))
                                        <small
                                            class="errorTxt">{{ $errors->first('question') }}</small>
                                    @endif
                                </div>

                                <div class="col s12">
                                    <label for="content">{{trans('admin.answer')}}</label>
                                    <textarea id="content" class="ckeditor form-control"
                                              name="answer">{{(count($help->availableLanguage) > 0) ?  $help->availableLanguage[0]->answer : ''}}</textarea>
                                </div>

                                <div class="input-field col s12">
                                    <button type="submit" class="btn indigo">
                                        @if($help->created_at){{trans('admin.update')}}@else{{trans('admin.create')}}@endif
                                    </button>
                                </div>
                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="{{asset('../admin/ckeditor/ckeditor.js')}}"></script>
@endsection
