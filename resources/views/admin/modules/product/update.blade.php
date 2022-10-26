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
                                        <input name="old-images[]" id="old_images" hidden disabled
                                               value="{{$product->files}}">
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('productUpdate',[app()->getLocale(),$product->id])}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="title" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}"
                                                                   data-error=".errorTxt">
                                                            <label for="title"
                                                                   class="active">{{trans('admin.title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif

                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="title" name="slug" type="text"
                                                                   class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"
                                                                   value="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->slug:""}}"
                                                                   data-error=".errorTxt">
                                                            <label for="title"
                                                                   class="active">{{trans('admin.slug')}}</label>
                                                            @if ($errors->has('slug'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('slug') }}</small>
                                                            @endif

                                                        </div>


                                                        <div class="col s12 input-field">

                                                            <select name="category_id" class="select2 browser-default">
                                                                <option value="" disabled selected>Choose your option
                                                                </option>
                                                                @foreach($categories as $category):
                                                                <option
                                                                    {{$product->category_id ==  $category->id   ?   "selected":""}} value="{{$category->id}}">{{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->title : ''}}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="category_id"
                                                                   class="">{{trans('admin.category_id')}}</label>
                                                            @if ($errors->has('category_id'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('category_id') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="price" name="price" type="number"
                                                                   class="validate {{ $errors->has('price') ? 'invalid' : 'valid' }}"
                                                                   value="{{$product->price}}"
                                                                   data-error=".errorTxt">
                                                            <label for="price"
                                                                   class="active">{{trans('admin.price')}}</label>
                                                            @if ($errors->has('price'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('price') }}</small>
                                                            @endif
                                                        </div>




                                                        {{--                                                        <div class="col s12 input-field">--}}
                                                        {{--                                                            <input id="slug" name="slug" type="text"--}}
                                                        {{--                                                                   class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"--}}
                                                        {{--                                                                   value="{{old('slug')}}"--}}
                                                        {{--                                                                   data-error=".errorTxt">--}}
                                                        {{--                                                            <label for="slug"--}}
                                                        {{--                                                                   class="active">{{trans('admin.slug')}}</label>--}}
                                                        {{--                                                            @if ($errors->has('slug'))--}}
                                                        {{--                                                                <small--}}
                                                        {{--                                                                    class="errorTxt">{{ $errors->first('slug') }}</small>--}}
                                                        {{--                                                            @endif--}}
                                                        {{--                                                        </div>--}}


                                                        <div class="col s12 input-field">
                                                            <input id="meta_title" name="meta_title" type="text"
                                                                   class="validate {{ $errors->has('meta_title') ? 'invalid' : 'valid' }}"
                                                                   value="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->meta_title:""}}"
                                                                   data-error=".errorTxt">
                                                            <label for="meta_title"
                                                                   class="active">{{trans('admin.meta_title')}}</label>
                                                            @if ($errors->has('meta_title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_title') }}</small>
                                                            @endif
                                                        </div>


                                                        <div class="col s12 input-field">
                                                            <input id="meta_description" name="meta_description"
                                                                   type="text"
                                                                   class="validate {{ $errors->has('meta_description') ? 'invalid' : 'valid' }}"
                                                                   value="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->meta_description:""}}"
                                                                   data-error=".errorTxt">
                                                            <label for="meta_description"
                                                                   class="active">{{trans('admin.meta_description')}}</label>
                                                            @if ($errors->has('meta_description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_description') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="meta_keyword" name="meta_keyword" type="text"
                                                                   class="validate {{ $errors->has('meta_keyword') ? 'invalid' : 'valid' }}"
                                                                   value="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->meta_keyword:""}}"
                                                                   data-error=".errorTxt">
                                                            <label for="meta_keyword"
                                                                   class="active">{{trans('admin.meta_keyword')}}</label>
                                                            @if ($errors->has('meta_keyword'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('meta_keyword') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12">
                                                            <label for="shipping">{{trans('admin.shipping')}}</label>
                                                            <textarea id="shipping" class="ckeditor form-control"
                                                                      name="shipping">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->shipping:""}} </textarea>
                                                            @if ($errors->has('shipping'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('shipping') }}</small>
                                                            @endif
                                                        </div>

                                                    </div>


                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row" id="feature-row">
                                                        <div class="col s12">
                                                            <label for="description">{{trans('admin.description')}}</label>
                                                            <textarea id="description" class="ckeditor form-control"
                                                                      name="description">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->description:""}}</textarea>
                                                            @if ($errors->has('description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('description') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12">
                                                            <label for="short_description">{{trans('admin.short_description')}}</label>
                                                            <textarea id="short_description" class="ckeditor form-control"
                                                                      name="short_description">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->short_description:""}} </textarea>
                                                            @if ($errors->has('short_description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('short_description') }}</small>
                                                            @endif
                                                        </div>
{{--                                                        <div class="col s12 input-field">--}}
{{--                                                          <textarea id="description" name="description"--}}
{{--                                                                    class="validate {{ $errors->has('description') ? 'invalid' : 'valid' }} materialize-textarea"--}}
{{--                                                                    data-error=".errorTxt"> {{count($product->availableLanguage)>0?$product->availableLanguage[0]->description:""}}</textarea>--}}
{{--                                                            <label for="description"--}}
{{--                                                                   class="active">{{trans('admin.description')}}</label>--}}
{{--                                                            @if ($errors->has('description'))--}}
{{--                                                                <small--}}
{{--                                                                    class="errorTxt">{{ $errors->first('description') }}</small>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col s12 input-field">--}}


{{--                                                        <textarea id="short_description" name="short_description"--}}
{{--                                                                  class="validate {{ $errors->has('short_description') ? 'invalid' : 'valid' }} materialize-textarea"--}}
{{--                                                                  data-error=".errorTxt"> {{count($product->availableLanguage)>0?$product->availableLanguage[0]->short_description:""}} </textarea>--}}
{{--                                                            <label for="short_description"--}}
{{--                                                                   class="active">{{trans('admin.short_description')}}</label>--}}
{{--                                                            @if ($errors->has('short_description'))--}}
{{--                                                                <small--}}
{{--                                                                    class="errorTxt">{{ $errors->first('short_description') }}</small>--}}
{{--                                                            @endif--}}


{{--                                                            --}}{{--                                                            <div--}}
{{--                                                            --}}{{--                                                                class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">--}}
{{--                                                            --}}{{--                                                                {{ Form::label('content', __('admin.content'), []) }}--}}
{{--                                                            --}}{{--                                                                {{ Form::textarea('content', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_content')]) }}--}}
{{--                                                            --}}{{--                                                                @if ($errors->has('content'))--}}
{{--                                                            --}}{{--                                                                    <span class="help-block">--}}
{{--                                                            --}}{{--                                                                    {{ $errors->first('content') }}--}}
{{--                                                            --}}{{--                                                               </span>--}}
{{--                                                            --}}{{--                                                                @endif--}}
{{--                                                            --}}{{--                                                            </div>--}}
{{--                                                        </div>--}}

                                                        <div class="col s12 input-field">
                                                            <input id="position" name="weight" type="number"
                                                                   class="validate {{ $errors->has('weight') ? 'invalid' : 'valid' }}"
                                                                   value="{{$product->weight}}"
                                                                   data-error=".errorTxt">
                                                            <label for="weight"
                                                                   class="active">{{trans('admin.weight')}}</label>
                                                            @if ($errors->has('weight'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('weight') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">

                                                            <select name="sale" class="select2 browser-default">
                                                                <option value="" selected>Choose your option
                                                                </option>
                                                                @foreach($sales as $sale):
                                                                <option
                                                                    {{$product->saleProduct?($product->saleProduct->sale_id ==  $sale->id ? "selected":""):""}} value="{{$sale->id}}">{{(count($sale->availableLanguage) > 0) ?  $sale->availableLanguage[0]->title : ''}}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="sale" class="">{{trans('admin.sale')}}</label>
                                                            @if ($errors->has('sale'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('sale') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">

                                                            <select name="feature[]"
                                                                    class="product_feature select2 browser-default"
                                                                    multiple="multiple">
                                                                <option value="" disabled>Choose your option
                                                                </option>
                                                                @foreach($features as $feature):
                                                                <option
                                                                    {{in_array($feature->id,$featureIdArray)? "selected":""}} value="{{$feature->id}}">{{(count($feature->availableLanguage) > 0) ?  $feature->availableLanguage[0]->title : ''}}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="feature"
                                                                   class="">{{trans('admin.feature')}}</label>
                                                            @if ($errors->has('feature'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('feature') }}</small>
                                                            @endif
                                                        </div>

                                                        @foreach($features as $feature)
                                                            @if(in_array($feature->id,$featureIdArray))
                                                                <div class="col s12 input-field"
                                                                     id="feature-{{$feature->id}}">
                                                                    <select
                                                                        name="answer[{{$feature->id}}][]"
                                                                        class="product_answer select2 browser-default"
                                                                        multiple="multiple">
                                                                        <option value="" disabled>Choose your option
                                                                        </option>
                                                                        @foreach($feature->answer as $answer)
                                                                            <option
                                                                                {{in_array($answer->id,$productAnswers)? "selected":""}} value="{{$answer->id}}">
                                                                                {{count($answer->availableLanguage)>0?$answer->availableLanguage[0]->title:""}}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                    <label for="feature"
                                                                           class="">{{count($feature->availableLanguage)>0?$feature->availableLanguage[0]->title:""}}</label>
                                                                    @if ($errors->has('feature'))
                                                                        <small
                                                                            class="errorTxt">{{ $errors->first('feature') }}</small>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>

                                                <div class="col s12">

                                                    <label>
                                                        <input type="checkbox"{{$product->sold?"checked":""}} name="sold">
                                                        <span>{{trans('admin.sold')}}</span>
                                                    </label>


                                                </div>
                                                <div class="col s12">

                                                    <label>
                                                        <input type="checkbox"
                                                               {{$product->status?"checked":""}} name="status">
                                                        <span>{{trans('admin.status')}}</span>
                                                    </label>


                                                </div>

                                                <div class="col s12">

                                                    <label>
                                                        <input type="checkbox"
                                                               {{$product->best_seller?"checked":""}} name="best_seller">
                                                        <span>{{trans('admin.best_seller')}}</span>
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

                                                <div class="col s12" style="margin-top:20px">
                                                    <h6>@lang('admin.img_alt')</h6>
                                                </div>

                                                @foreach($product->files as $file)
                                                <div class="col s12">
                                                    <input name="alt[{{$file->id}}]" type="text"
                                                           value="{{count($file->availableLanguage)>0?$file->availableLanguage[0]->title:""}}" placeholder="{{$loop->iteration}}) @lang('admin.img_alt')">
                                                </div>

                                                @endforeach

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
    <script src="{{asset('../admin/ckeditor/ckeditor.js')}}"></script>

@endsection
