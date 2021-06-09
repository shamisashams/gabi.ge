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
                                          action="{{route('productCreate',app()->getLocale())}}" method="POST" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="title" name="title" type="text"
                                                               class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                               value="{{old('title')}}"
                                                               data-error=".errorTxt">
                                                        <label for="title"
                                                               class="active">{{trans('admin.title')}}</label>
                                                        @if ($errors->has('title'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('title') }}</small>
                                                        @endif

                                                    </div>


                                                    <div class="col s12 input-field">

                                                        <select name="category_id" class="select2 browser-default">
                                                            <option value="" disabled selected>Choose your option
                                                            </option>
                                                            @foreach($categories as $category):
                                                            <option {{old('category_id') ==  $category->id   ?   "selected":""}} value="{{$category->id}}">{{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->title : ''}}</option>
                                                            @endforeach

                                                        </select>
                                                        <label for="category_id" class="">{{trans('admin.category_id')}}</label>
                                                        @if ($errors->has('category_id'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('category_id') }}</small>
                                                        @endif
                                                    </div>

                                                    <div class="col s12 input-field">
                                                        <input id="price" name="price" type="number"
                                                               class="validate {{ $errors->has('price') ? 'invalid' : 'valid' }}"
                                                               value="{{old('price')}}"
                                                               data-error=".errorTxt">
                                                        <label for="price"
                                                               class="active">{{trans('admin.price')}}</label>
                                                        @if ($errors->has('price'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('price') }}</small>
                                                        @endif
                                                    </div>



                                                    <div class="col s12 input-field">
                                                        <input id="slug" name="slug" type="text"
                                                               class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"
                                                               value="{{old('slug')}}"
                                                               data-error=".errorTxt">
                                                        <label for="slug"
                                                               class="active">{{trans('admin.slug')}}</label>
                                                        @if ($errors->has('slug'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('slug') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="description" name="description" type="text"
                                                               class="validate {{ $errors->has('native') ? 'invalid' : 'valid' }}"
                                                               value="{{old('description')}}"
                                                               data-error=".errorTxt">
                                                        <label for="description"
                                                               class="active">{{trans('admin.description')}}</label>
                                                        @if ($errors->has('description'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('description') }}</small>
                                                        @endif
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="position" name="position" type="number"
                                                               class="validate {{ $errors->has('position') ? 'invalid' : 'valid' }}"
                                                               value="{{old('position')}}"
                                                               data-error=".errorTxt">
                                                        <label for="position"
                                                               class="active">{{trans('admin.position')}}</label>
                                                        @if ($errors->has('position'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('position') }}</small>
                                                        @endif
                                                    </div>

                                                    <div class="col s12 input-field">


                                                        <textarea id="short_description" name="short_description" 
                                                                  class="validate {{ $errors->has('short_description') ? 'invalid' : 'valid' }}"
                                                                  data-error=".errorTxt"> {{old('short_description')}} </textarea>
                                                        <label for="short_description"
                                                               class="active">{{trans('admin.short_description')}}</label>
                                                        @if ($errors->has('short_description'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('short_description') }}</small>
                                                        @endif


                                                        <!--							<div
                                                                                                                    class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                                                                                                    {{ Form::label('content', __('admin.content'), []) }}
                                                                                                                    {{ Form::textarea('content', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_content')]) }}
                                                                                                                    @if ($errors->has('content'))
                                                                                                                    <span class="help-block">
                                                                                                                        {{ $errors->first('content') }}
                                                                                                                    </span>
                                                                                                                    @endif
                                                                                                                </div>-->
                                                    </div>



                                                    <div class="col s12 input-field">

                                                        <select name="feature" class="product_feature select2 browser-default">
                                                            <option value="" disabled selected>Choose your option
                                                            </option>
                                                            @foreach($features as $feature):
                                                            <option {{old('feature') ==  $feature  ?   "selected":""}} value="{{$feature->id}}">{{(count($feature->availableLanguage) > 0) ?  $feature->availableLanguage[0]->title : ''}}</option>
                                                            @endforeach

                                                        </select>
                                                        <label for="feature" class="">{{trans('admin.feature')}}</label>
                                                        @if ($errors->has('feature'))
                                                        <small
                                                            class="errorTxt">{{ $errors->first('feature') }}</small>
                                                        @endif
                                                    </div>


                                                    <div class="col s12 input-field product_feature_answers">
                                                        
                                                    </div>




                                                </div>
                                            </div>

                                            <div class="col s12">

                                                <label>
                                                    <input type="checkbox" name="status">
                                                    <span>{{trans('admin.status')}}</span>
                                                </label>


                                            </div>

                                            <div class="col s12 m6" style="margin-top:20px">
                                                <div class="input-images"></div>
                                                @if ($errors->has('images'))
                                                <span class="help-block">
                                                    {{ $errors->first('images') }}
                                                </span>
                                                @endif
                                            </div>

                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn indigo">
                                                    {{trans('admin.create')}}
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
