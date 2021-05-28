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
                                <!-- <div class="card-body"> -->
                                <ul class="tabs mb-2 row">
                                    <li class="tab">
                                        <a class="display-flex align-items-center active" id="account-tab"
                                           href="#account">
                                            <i class="material-icons mr-1">person_outline</i><span>Account</span>
                                        </a>
                                    </li>
                                    <li class="tab">
                                        <a class="display-flex align-items-center" id="information-tab"
                                           href="#information">
                                            <i class="material-icons mr-2">error_outline</i><span>Information</span>
                                        </a>
                                    </li>
                                    <li class="indicator" style="left: 0px; right: 602px;"></li>
                                </ul>
                                <div class="divider mb-3"></div>
                                <div class="row">
                                    <div class="col s12 active" id="account">
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form id="accountForm" novalidate="novalidate">
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="username" name="title" type="text"
                                                                   class="validate valid" value="{{$language->title}}"
                                                                   data-error=".errorTxt1">
                                                            <label for="username" class="active">{{trans('admin.title')}}</label>
                                                            <small class="errorTxt1"></small>
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input id="name" name="abbreviation" type="text" class="validate"
                                                                   value="{{$language->abbreviation}}" data-error=".errorTxt2">
                                                            <label for="name" class="active">{{trans('admin.abbreviation')}}</label>
                                                            <small class="errorTxt2"></small>
                                                        </div>
                                                    </div>
                                                    <label>
                                                        <input type="checkbox" checked="">
                                                        <span>{{trans('admin.status')}}</span>
                                                    </label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" checked="">
                                                        <span>{{trans('admin.default')}}</span>
                                                    </label>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="col s12 input-field">
                                                        <input id="email" name="native" type="email" class="validate"
                                                               value="{{$language->native}}"
                                                               data-error=".errorTxt3">
                                                        <label for="email" class="active">{{trans('admin.native')}}</label>
                                                        <small class="errorTxt3"></small>
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="email" name="native" type="email" class="validate"
                                                               value="{{$language->locale}}"
                                                               data-error=".errorTxt3">
                                                        <label for="email" class="active">{{trans('admin.locale')}}</label>
                                                        <small class="errorTxt3"></small>
                                                    </div>
                                                </div>
                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn indigo">
                                                        Save changes
                                                    </button>
                                                    <button type="button" class="btn btn-light">Cancel</button>
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
