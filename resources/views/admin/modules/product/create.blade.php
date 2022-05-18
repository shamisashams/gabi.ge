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
                                              action="{{route('productStore',app()->getLocale())}}" method="POST"
                                              enctype="multipart/form-data">
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


                                                        <div class="col s12 input-field">

                                                            <select name="category_id" class="select2 browser-default">
                                                                <option value="" disabled selected>Choose your option
                                                                </option>
                                                                @foreach($categories as $category):
                                                                <option
                                                                    {{old('category_id') ==  $category->id   ?   "selected":""}} value="{{$category->id}}">{{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->title : ''}}</option>
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
                                                                   value="{{old('price')}}"
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
                                                                   value="{{old('meta_title')}}"
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
                                                                   value="{{old('meta_description')}}"
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
                                                                   value="{{old('meta_keyword')}}"
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
                                                                      name="shipping">{{old('shipping')}}</textarea>
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
                                                                      name="description">{{old('description')}}</textarea>
                                                            @if ($errors->has('description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('description') }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="col s12">
                                                            <label for="short_description">{{trans('admin.short_description')}}</label>
                                                            <textarea id="short_description" class="ckeditor form-control"
                                                                      name="short_description">{{old('short_description')}}</textarea>
                                                            @if ($errors->has('short_description'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('short_description') }}</small>
                                                            @endif
                                                        </div>
{{--                                                        <div class="col s12 input-field">--}}
{{--                                                         <textarea id="description" name="description"--}}
{{--                                                                   class="validate {{ $errors->has('description') ? 'invalid' : 'valid' }} materialize-textarea"--}}
{{--                                                                   data-error=".errorTxt"></textarea>--}}
{{--                                                            <label for="description"--}}
{{--                                                                   class="active">{{trans('admin.description')}}</label>--}}
{{--                                                            @if ($errors->has('description'))--}}
{{--                                                                <small--}}
{{--                                                                    class="errorTxt">{{ $errors->first('description') }}</small>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}


                                                        <div class="col s12 input-field">



{{--                                                   <textarea id="short_description" name="short_description"--}}
{{--                                                             class="validate {{ $errors->has('short_description') ? 'invalid' : 'valid' }} materialize-textarea"--}}
{{--                                                             data-error=".errorTxt"></textarea>--}}
{{--                                                            <label for="short_description"--}}
{{--                                                                   class="active">{{trans('admin.short_description')}}</label>--}}
{{--                                                            @if ($errors->has('short_description'))--}}
{{--                                                                <small--}}
{{--                                                                    class="errorTxt">{{ $errors->first('short_description') }}</small>--}}
{{--                                                            @endif--}}


                                                            {{--                                                            <div--}}
                                                            {{--                                                                class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">--}}
                                                            {{--                                                                {{ Form::label('content', __('admin.content'), []) }}--}}
                                                            {{--                                                                {{ Form::textarea('content', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_content')]) }}--}}
                                                            {{--                                                                @if ($errors->has('content'))--}}
                                                            {{--                                                                    <span class="help-block">--}}
                                                            {{--                                                                    {{ $errors->first('content') }}--}}
                                                            {{--                                                               </span>--}}
                                                            {{--                                                                @endif--}}
                                                            {{--                                                            </div>--}}
                                                        </div>

                                                        <div class="col s12 input-field">
                                                            <input id="position" name="weight" type="number"
                                                                   class="validate {{ $errors->has('weight') ? 'invalid' : 'valid' }}"
                                                                   value="{{old('weight')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="position"
                                                                   class="active">{{trans('admin.weight')}}</label>
                                                            @if ($errors->has('weight'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('weight') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">

                                                            <select name="sale" class="select2 browser-default">
                                                                <option value="" disabled selected>Choose your option
                                                                </option>
                                                                @foreach($sales as $sale):
                                                                <option
                                                                    {{old('sale') ==  $sale->id   ?   "selected":""}} value="{{$sale->id}}">{{(count($sale->availableLanguage) > 0) ?  $sale->availableLanguage[0]->title : ''}}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="sale" class="">{{trans('admin.sale')}}</label>
                                                            @if ($errors->has('sale'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('sale') }}</small>
                                                            @endif
                                                        </div>

                                                        <div class="col s12 input-field">

                                                            <select onselect="alert(22)" name="feature[]"
                                                                    class="product_feature select2 browser-default"
                                                                    multiple="multiple">
                                                                <option value="" disabled>Choose your option
                                                                </option>
                                                                @foreach($features as $feature):
                                                                <option
                                                                    {{old('feature') ==  $feature  ?   "selected":""}} value="{{$feature->id}}">{{(count($feature->availableLanguage) > 0) ?  $feature->availableLanguage[0]->title : ''}}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="feature"
                                                                   class="">{{trans('admin.feature')}}</label>
                                                            @if ($errors->has('feature'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('feature') }}</small>
                                                            @endif
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
    <script src="{{asset('../admin/ckeditor/ckeditor.js')}}"></script>

@endsection

@push('script')

    <script>
        function containsWhitespace(str) {
            return /\s/.test(str);
        }

        $('button[type=submit]').click(function (e){
            //console.log(CKEDITOR.instances.description.getData())
            let error = 0;
            if($('input[name=title]').val() == ''){
                error++;
                $('label[for=title]').css('color','red');
            } else {
                $('label[for=title]').css('color','#9e9e9e');

            }
            if($('input[name=slug]').val().trim() == ''){
                error++;
                $('label[for=slug]').css('color','red');
            }
            else if (containsWhitespace($('input[name=slug]').val())){
                error++;
                $('label[for=slug]').css('color','red');
                alert('slug contains spaces!')
            }
            else {
                $('label[for=slug]').css('color','#9e9e9e');
            }

            /*if(containsWhitespace($('input[name=slug]').val())){
                error++;
                $('label[for=slug]').css('color','red');
                alert('slug contains spaces!')
                return false
            } else {
                $('label[for=slug]').css('color','#9e9e9e');
            }*/
            if($('select[name=category_id]').val() == null){
                error++;
                $('label[for=category_id]').css('color','red');
            } else {
                $('label[for=category_id]').css('color','#9e9e9e');
            }
            if($('input[name=price]').val() == ''){
                error++;
                $('label[for=price]').css('color','red');
            } else {
                $('label[for=price]').css('color','#9e9e9e');
            }
            if(CKEDITOR.instances.description.getData().trim() == ''){
                error++;
                $('label[for=description]').css('color','red');
            } else {
                $('label[for=description]').css('color','#9e9e9e');
            }
            if($('input[name=weight]').val() == ''){
                error++;
                $('label[for=position]').css('color','red');
            } else {
                $('label[for=position]').css('color','#9e9e9e');
            }
            if(error > 0){
                alert('Please fill-out required fields')
                return false
            }
        });
    </script>
@endpush
