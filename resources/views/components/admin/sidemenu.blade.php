<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{route('adminHome',app()->getLocale())}}"><img class="hide-on-med-and-down" src="/admin/images/logo/materialize-logo-color.png" alt="materialize logo"/><img class="show-on-medium-and-down hide-on-med-and-up" src="../../../app-assets/images/logo/materialize-logo.png" alt="materialize logo"/><span class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
{{--        <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge pill orange float-right mr-10">3</span></a>--}}
{{--            <div class="collapsible-body">--}}
{{--                <ul class="collapsible collapsible-sub" data-collapsible="accordion">--}}
{{--                    <li class="active"><a class="active" href="dashboard-modern.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Modern</span></a>--}}
{{--                    </li>--}}
{{--                    <li><a href="dashboard-ecommerce.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="eCommerce">eCommerce</span></a>--}}
{{--                    </li>--}}
{{--                    <li><a href="dashboard-analytics.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Analytics</span></a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
        <li class="bold"><a class="waves-effect waves-cyan {{str_contains(route('languageIndex',app()->getLocale()),request()->path())?"active":""}} " href="{{route('languageIndex',app()->getLocale())}}"><i class="material-icons">import_contacts</i><span class="menu-title" data-i18n="Mail">{{trans('admin.languages')}}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan {{str_contains(route('translationIndex',app()->getLocale()),request()->path())?"active":""}}" href="{{route('translationIndex',app()->getLocale())}}"><i class="material-icons dp48">g_translate</i><span>{{trans('admin.translations')}}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan {{str_contains(route('featureIndex',app()->getLocale()),request()->path())?"active":""}}" href="{{route('featureIndex',app()->getLocale())}}"><i class="material-icons dp48">g_translate</i><span>{{trans('admin.features')}}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan {{str_contains(route('answerIndex',app()->getLocale()),request()->path())?"active":""}}" href="{{route('answerIndex',app()->getLocale())}}"><i class="material-icons dp48">g_translate</i><span>{{trans('admin.answers')}}</span></a>
        </li>

    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
