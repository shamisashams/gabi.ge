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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link href="{{asset('../admin/vendors/vendors.min.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/vendors/animate-css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/vendors/chartist-js/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/vendors/chartist-js/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link href="{{asset('../admin/css/themes/vertical-modern-menu-template/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/css/themes/vertical-modern-menu-template/style.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/css/pages/dashboard-modern.css')}}" rel="stylesheet">
    <link href="{{asset('../admin/css/pages/intro.css')}}" rel="stylesheet">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link href="{{asset('../admin/css/custom/custom.css')}}" rel="stylesheet">
    <!-- END: Custom CSS-->
    {{--    <link href="{{asset('../adm/uploader/image-uploader.css')}}" rel="stylesheet">--}}
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="with-content-panel menu-position-side menu-side-left full-screen" style="padding-bottom:0">

<x-admin.navbar/>
<x-admin.sidemenu/>
<div id="main">
    @yield('body')
</div>
<x-admin.footer/>

<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('../admin/js/vendors.min.js')}}"></script>
<script src="{{asset('../admin/vendors/chartjs/chart.min.js')}}"></script>
<script src="{{asset('../admin/vendors/chartist-js/chartist.min.js')}}"></script>
<script src="{{asset('../admin/vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('../admin/vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('../admin/js/plugins.js')}}"></script>
<script src="{{asset('../admin/js/search.js')}}"></script>
<script src="{{asset('../admin/js/custom/custom-script.js')}}"></script>
<script src="{{asset('../admin/js/scripts/customizer.js')}}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('../admin/js/scripts/dashboard-modern.js')}}"></script>
<script src="{{asset('../admin/js/scripts/intro.js')}}"></script>
</body>
</html>
