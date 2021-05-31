@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <!-- users view start -->
                    <div class="section users-view">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m4">
                                        <table class="striped">
                                            <tbody>
                                            <tr>
                                                <td>{{trans('admin.key')}}:</td>
                                                <td>{{$translation->key}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.group')}}:</td>
                                                <td class="users-view-latest-activity">{{$translation->group}}</td>
                                            </tr>
                                            @foreach($languages as $language)
                                                <tr>
                                                    <td>{{$language->abbreviation}}:</td>
                                                    <td>{{isset($translation->text[$language->abbreviation])?$translation->text[$language->abbreviation]:""}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
