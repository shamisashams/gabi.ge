<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @hasSection('title')

        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="/favicon.ico" rel="shortcut icon">
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link href="{{asset('../admin/vendors/vendors.min.css')}}" rel="stylesheet">

    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link href="{{asset('../admin/css/themes/vertical-modern-menu-template/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/css/themes/vertical-modern-menu-template/style.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/css/pages/login.css')}}" rel="stylesheet">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link href="{{asset('../admin/css/custom/custom.css')}}" rel="stylesheet">
    <!-- END: Custom CSS-->
    {{--    <link href="{{asset('../adm/uploader/image-uploader.css')}}" rel="stylesheet">--}}
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
@yield('body')

<script src="{{asset('../admin/js/vendors.min.js')}}"></script>
<script src="{{asset('../admin/js/plugins.js')}}"></script>
<script src="{{asset('../admin/js/search.js')}}"></script>
<script src="{{asset('../admin/js/custom/custom-script.js')}}"></script>

</body>
</html>
