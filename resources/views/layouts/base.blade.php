<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="facebook-domain-verification" content="6ztqz12hxgejgtyjugys9wdvdlqrci" />
    @yield('head')

    <meta name="language" content="{{app()->getLocale()}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="author" content="">
    <meta name="author" content="insite.international">
    <link href="/favicon.ico" rel="shortcut icon">
    {{--    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">--}}

    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link href="{{asset('../css/style.css?v=2')}}" rel="stylesheet">


    <script>

        function __ (key){
            let data = key.split('.');
            let translations = @json($client_translation);

            if(translations.hasOwnProperty(data[1])){
                return translations[data[1]];
            }
        }

        // alert( __('client.success'));
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-915J99RPWW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-915J99RPWW');
    </script>


</head>

<body>
<div id="preloader">
            <div class="loader">
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__ball"></div>
            </div>
        </div>
{{--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0"--}}
{{--        nonce="3c3lKlK8"></script>--}}

<x-navbar/>
{{--<x-cart/>--}}
@yield('content')
<x-footer/>
<div id="popup_bg" class="popup_bg flex center"></div>


<!-- regular js-->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{asset('../js/slide.js')}}"></script>
<script src="{{asset('../js/general.js?v=2348110516689')}}"></script>
<script src="{{asset('../js/main.js')}}"></script>
<script src="{{asset('../js/magnifier.js')}}"></script>

@stack('script')

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v14.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
     attribution="install_email"
     attribution_version="biz_inbox"
     page_id="105344308442775">
</div>
</body>

</html>
