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
@yield('body')


{{--<script src="{{asset('../adm/bower_components/jquery/dist/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/popper.js/dist/umd/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/moment/moment.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/chart.js/dist/Chart.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/ckeditor/ckeditor.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/dropzone/dist/dropzone.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/editable-table/mindmup-editabletable.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/tether/dist/js/tether.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/slick-carousel/slick/slick.min.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/util.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/alert.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/button.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/carousel.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/collapse.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/dropdown.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/modal.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/tab.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/tooltip.js')}}"></script>--}}
{{--<script src="{{asset('../adm/bower_components/bootstrap/js/dist/popover.js')}}"></script>--}}
{{--<script src="{{asset('../adm/js/demo_customizer.js?version=4.4.0')}}"></script>--}}
{{--<script src="{{asset('../adm/js/main.js?version=4.4.0')}}"></script>--}}
{{--<script src="{{asset('../adm/uploader/image-uploader.js')}}"></script>--}}
{{--<script src="{{asset('../js/app.js')}}"></script>--}}
{{--<script>--}}
{{--    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){--}}
{{--        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),--}}
{{--        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)--}}
{{--    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');--}}

{{--    ga('create', 'UA-XXXXXXX-9', 'auto');--}}
{{--    ga('send', 'pageview');--}}
{{--</script>--}}
</body>
</html>
