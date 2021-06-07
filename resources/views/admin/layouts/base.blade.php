<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
          content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Dashboard Modern | Materialize - Material Design Admin Template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
    <!-- BEGIN: VENDOR CSS-->
{{--    <link href="{{asset('../admin/vendors/vendors.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('../admin/vendors/animate-css/animate.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('../admin/vendors/chartist-js/chartist.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('../admin/vendors/chartist-js/chartist-plugin-tooltip.css')}}" rel="stylesheet">--}}
<!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link href="{{asset('../admin/css/themes/vertical-modern-menu-template/materialize.min.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/css/themes/vertical-modern-menu-template/style.min.css')}}" rel="stylesheet">
    {{--    <link href="{{asset('../admin/css/pages/dashboard-modern.css')}}" rel="stylesheet">--}}
    {{--    <link href="{{asset('../admin/css/pages/form-select2.css')}}" rel="stylesheet">--}}
    {{--    <link href="{{asset('../admin/vendors/select2/select2.min.css')}}" rel="stylesheet">--}}
    <link href="{{asset('../admin/vendors/select2/select2-materialize.css')}}" rel="stylesheet">
    {{--    <link href="{{asset('../admin/css/pages/page-users.css')}}" rel="stylesheet">--}}
    {{--    <link href="{{asset('../admin/css/pages/intro.css')}}" rel="stylesheet">--}}
    <link href="{{asset('../admin/uploader/image-uploader.css')}}" rel="stylesheet">
    <script src="jquery-3.5.1.min.js"></script>
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link href="{{asset('../admin/css/custom/custom.css')}}" rel="stylesheet">
    <!-- END: Custom CSS-->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="with-content-panel menu-position-side menu-side-left full-screen" style="padding-bottom:0">

{{--<x-admin.dashboard/>--}}
<x-admin.navbar/>
<x-admin.sidemenu/>
<div id="main">
    <x-admin.breadcrumb/>
    @yield('body')
</div>


<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('../admin/js/vendors.min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('../admin/js/plugins.js')}}"></script>
<script src="{{asset('../admin/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('../admin/js/custom/custom-script.js')}}"></script>
{{--<script src="{{asset('../admin/js/scripts/customizer.js')}}"></script>--}}
<script src="{{asset('../admin/js/scripts/ui-alerts.js')}}"></script>
<script src="{{asset('../admin/uploader/image-uploader.js')}}"></script>
<script src="{{asset('../js/app.js')}}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{--<script src="{{asset('../admin/js/scripts/dashboard-modern.js')}}"></script>--}}
{{--<script src="{{asset('../admin/js/scripts/intro.js')}}"></script>--}}
</body>
</html>
