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
                                        <form method="post" action="{{route('password.update',app()->getLocale())}}">

                                            @csrf

                                            <div class="row">
                                                <div class="col s12 m12">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="c_pass" name="c_pass" type="password"
                                                                   class="validate {{ $errors->has('c_pass') ? 'invalid' : 'valid' }}"
                                                                   data-error=".errorTxt">
                                                            <label for="username"
                                                                   class="active">{{trans('admin.c_pass')}}</label>
                                                            @if ($errors->has('c_pass'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('c_pass') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="n_pass" name="n_pass" type="password"
                                                                   class="validate {{ $errors->has('n_pass') ? 'invalid' : 'valid' }}"
                                                                   data-error=".errorTxt">
                                                            <label for="n_pass"
                                                                   class="active">{{trans('admin.n_pass')}}</label>
                                                            @if ($errors->has('n_pass'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('n_pass') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="r_pass" name="r_pass" type="password"
                                                                   class="validate {{ $errors->has('r_pass') ? 'invalid' : 'valid' }}"
                                                                   data-error=".errorTxt">
                                                            <label for="r_pass"
                                                                   class="active">{{trans('admin.r_pass')}}</label>
                                                            @if ($errors->has('r_pass'))
                                                                <small
                                                                    class="errorTxt">{{ $errors->first('r_pass') }}</small>
                                                            @endif
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
