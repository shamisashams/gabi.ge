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


                                            @csrf
                                            <div class="row">
                                                <div class="col s12 m12">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="title" type="text"
                                                                   class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
                                                                   value="{{$item->language ? $item->language->title : old('title')}}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.country_title')}}</label>
                                                            @if ($errors->has('title'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('title') }}</small>
                                                            @endif

                                                        </div>
                                                        <div class="col s12">
                                                            <button id="add_city" class="btn" type="button">{{trans('admin.add_city')}}</button>
                                                        </div>
                                                        <div class="col s12 input-field" id="city_list">
                                                            @foreach($item->cities as $city)
                                                            <div class="row city">
                                                                <div class="col s5 input-field">
                                                                    <input name="city_title_u[{{$city->id}}]" type="text"
                                                                           class="validate {{ $errors->has('city_title') ? 'invalid' : 'valid' }}"
                                                                           value="{{$city->language ? $city->language->title : old('city_title.*')}}"
                                                                           data-error=".errorTxt">
                                                                    <label for="username"
                                                                           class="active">{{trans('admin.city_title')}}</label>
                                                                    @if ($errors->has('title'))
                                                                        <small
                                                                            class="errorTxt">{{ $errors->first('title') }}</small>
                                                                    @endif

                                                                </div>
                                                                <div class="col s5 input-field">
                                                                    <input name="city_price_u[{{$city->id}}]" type="number"
                                                                           class="validate {{ $errors->has('city_price.*') ? 'invalid' : 'valid' }}"
                                                                           value="{{$city->ship_price }}"
                                                                           data-error=".errorTxt">
                                                                    <label for="username"
                                                                           class="active">{{trans('admin.city_ship_price')}}</label>
                                                                    @if ($errors->has('city_price.*'))
                                                                        <small
                                                                            class="errorTxt">{{ $errors->first('city_price.*') }}</small>
                                                                    @endif

                                                                </div>
                                                                <div class="col s2">
                                                                    <button data-del_ex="{{$city->id}}" type="button" class="btn btn-flat">delete</button>
                                                                </div>
                                                            </div>
                                                            @endforeach
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

@push('script')
    <script>
        $('#add_city').click(function (e){
            let row = `<div class="row city">
                            <div class="col s5 input-field">
                                <input name="city_title[]" type="text"
                                       class="validate"
                                       value=""
                                       data-error=".errorTxt">
                                <label for="username"
                                       class="active">{{trans('admin.city_name')}}</label>


            </div>
            <div class="col s5 input-field">
                <input name="city_price[]" type="number"
               class="validate"
                       value=""
                       data-error=".errorTxt">
                <label for="username"
                       class="active">{{trans('admin.city_ship_price')}}</label>


            </div>
            <div class="col s2">
                                                                    <button type="button" class="btn btn-flat del_new">delete</button>
                                                                </div>
        </div>`;
            $('#city_list').append(row);

        });

        $(document).on('click','.del_new',function (e){
            $(this).parents('.city').remove();
        });
        $('[data-del_ex]').click(function (e){
            let id = $(this).data('del_ex');
            let inp = `<input type="hidden" name="del_city[]" value="${id}">`;
            $('#city_list').append(inp);
            $(this).parents('.city').remove();
        });
    </script>
@endpush
