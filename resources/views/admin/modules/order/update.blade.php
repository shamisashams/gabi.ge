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
                                        <input name="old-images[]" id="old_images" hidden disabled value="{{$user->files}}">
                                        <form id="accountForm" novalidate="novalidate"
                                              action="{{route('orderUpdate',[app()->getLocale(),$user->id])}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            {{method_field('PUT')}}
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="row">

                                                <div class="col s12">

{{--                                                    <label>--}}
{{--                                                        <input type="checkbox" {{$user->status?"checked":""}} name="status">--}}
{{--                                                        <span>{{trans('admin.status')}}</span>--}}
{{--                                                    </label>--}}
                                                    <label for="cars">{{trans('admin.status')}}</label>

                                                    <select name="status" id="cars">
                                                        <option value="1" {{$user->status == 1 ?"selected":""}}>{{trans('success')}}</option>
                                                        <option value="2" {{$user->status == 2 ?"selected":""}}>{{trans('fail')}}</option>
                                                        <option value="3" {{$user->status == 3 ?"selected":""}}>{{trans('pending')}}</option>
                                                    </select>
                                                </div>
{{--                                                <div class="col s12 m6" style="margin-top:20px">--}}
{{--                                                    <div class="input-images"></div>--}}
{{--                                                    @if ($errors->has('images'))--}}
{{--                                                        <span class="help-block">--}}
{{--                                                         {{ $errors->first('images') }}--}}
{{--                                                        </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
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
@endsection
