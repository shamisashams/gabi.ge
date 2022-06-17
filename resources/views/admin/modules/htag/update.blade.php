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
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('hTagUpdate',[app()->getLocale(),$setting->id])}}"
                                              method="POST">
                                            {{ method_field('PUT') }}
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
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select name="value[details]">
                                                                <option value=""></option>
                                                                @foreach($htags as $htag)
                                                                    <option {{isset($setting->value->details) && $setting->value->details == $htag ? 'selected':''}}>{{$htag}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="username1"
                                                                   class="active">{{trans('admin.details_value')}}</label>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select name="value[slider]">
                                                                <option value=""></option>
                                                                @foreach($htags as $htag)
                                                                    <option {{isset($setting->value->slider) && $setting->value->slider == $htag ? 'selected':''}}>{{$htag}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="username8"
                                                                   class="active">{{trans('admin.slider_value')}}</label>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select name="value[slider_2]">
                                                                <option value=""></option>
                                                                @foreach($htags as $htag)
                                                                    <option {{isset($setting->value->slider_2) && $setting->value->slider_2 == $htag ? 'selected':''}}>{{$htag}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="ht"
                                                                   class="active">{{trans('admin.slider2_value')}}</label>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select name="value[slider_3]">
                                                                <option value=""></option>
                                                                @foreach($htags as $htag)
                                                                    <option {{isset($setting->value->slider_3) && $setting->value->slider_3 == $htag ? 'selected':''}}>{{$htag}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="username4"
                                                                   class="active">{{trans('admin.slider3_value')}}</label>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select id="cat" name="value[category]">
                                                                <option value=""></option>
                                                                @foreach($htags as $htag)
                                                                    <option {{isset($setting->value->category) && $setting->value->category == $htag ? 'selected':''}}>{{$htag}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="cat"
                                                                   class="active">{{trans('admin.category_value')}}</label>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col s12 m6">

                                                    <div class="col s12">
                                                        <button type="submit" class="btn indigo">
                                                            {{trans('admin.update')}}
                                                        </button>
                                                    </div>
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
