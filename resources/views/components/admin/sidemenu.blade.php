<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{route('adminHome',app()->getLocale())}}"><img
                    class="hide-on-med-and-down" src="/admin/images/logo/materialize-logo-color.png"
                    alt="materialize logo"/><img class="show-on-medium-and-down hide-on-med-and-up"
                                                 src="../../../app-assets/images/logo/materialize-logo.png"
                                                 alt="materialize logo"/><span class="logo-text hide-on-med-and-down">Materialize</span></a><a
                class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">

        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('languageIndex',app()->getLocale()),request()->path())?"active":""}} "
                href="{{route('languageIndex',app()->getLocale())}}"><i class="material-icons">import_contacts</i><span
                    class="menu-title" data-i18n="Mail">{{trans('admin.languages')}}</span></a>

        </li>

        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('translationIndex',app()->getLocale()),request()->path())?"active":""}}"
                href="{{route('translationIndex',app()->getLocale())}}"><i
                    class="material-icons dp48">g_translate</i><span>{{trans('admin.translations')}}</span></a>
        </li>

        <li class="bold"><a
                class="waves-effect waves-cyan" {{str_contains(route('categoryIndex',app()->getLocale()),request()->path())?"active":""}}
            " href="{{route('categoryIndex',app()->getLocale())}}"><i class="material-icons">import_contacts</i><span
                class="menu-title" data-i18n="Mail">{{trans('admin.categories')}}</span></a>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan"
                            {{str_contains(route('productIndex',app()->getLocale()),request()->path())?"active":""}} href="{{route('productIndex',app()->getLocale())}}"><i
                    class="material-icons">import_contacts</i><span class="menu-title" data-i18n="Mail">{{trans('admin.products')}}</span></a>
        </li>
        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('featureIndex',app()->getLocale()),request()->path())?"active":""}}"
                href="{{route('featureIndex',app()->getLocale())}}"><i
                    class="material-icons dp48">g_translate</i><span>{{trans('admin.features')}}</span></a>

        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('answerIndex',app()->getLocale()),request()->path())?"active":""}}"
                href="{{route('answerIndex',app()->getLocale())}}"><i
                    class="material-icons dp48">g_translate</i><span>{{trans('admin.answers')}}</span></a></li>

        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('settingIndex',app()->getLocale()),request()->path())?"active":""}}"
                href="{{route('settingIndex',app()->getLocale())}}"><i
                    class="material-icons dp48">g_translate</i><span>{{trans('admin.settings')}}</span></a>
        </li>

    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
       href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
