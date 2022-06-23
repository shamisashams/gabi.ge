<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{route('adminHome',app()->getLocale())}}"><img
                    class="hide-on-med-and-down" src="/admin/images/logo/materialize-logo-color.png"
                    alt="materialize logo"/><img class="show-on-medium-and-down hide-on-med-and-up"
                                                 src="../../../app-assets/images/logo/materialize-logo.png"
                                                 alt="materialize logo"/><span class="logo-text hide-on-med-and-down">Gabi</span></a><a
                class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">


        <li class="{{str_contains(route('languageIndex',app()->getLocale()),request()->path()) || str_contains(route('translationIndex',app()->getLocale()),request()->path()) ?'active':''}} bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">language</i><span class="menu-title" data-i18n="Pages">{{trans('admin.languages')}}</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li {!! str_contains(route('languageIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('languageIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('languageIndex',app()->getLocale())}}"><i class="material-icons">import_contacts</i><span data-i18n="Page Blank">{{trans('admin.add_language')}}</span></a>
                    </li>
                    <li {!! str_contains(route('translationIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('translationIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('translationIndex',app()->getLocale())}}"><i class="material-icons">g_translate</i><span data-i18n="Page Blank">{{trans('admin.translations')}}</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="{{str_contains(route('productIndex',app()->getLocale()),request()->path()) || str_contains(route('categoryIndex',app()->getLocale()),request()->path()) || str_contains(route('featureIndex',app()->getLocale()),request()->path()) || str_contains(route('answerIndex',app()->getLocale()),request()->path()) || str_contains(route('saleIndex',app()->getLocale()),request()->path()) ?'active':''}} bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">format_list_bulleted</i><span class="menu-title" data-i18n="Pages">{{trans('admin.catalog')}}</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li {!! str_contains(route('productIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('productIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('productIndex',app()->getLocale())}}"><i class="material-icons">import_contacts</i><span data-i18n="Page Blank">{{trans('admin.products')}}</span></a>
                    </li>
                    <li {!! str_contains(route('categoryIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('categoryIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('categoryIndex',app()->getLocale())}}"><i class="material-icons">category</i><span data-i18n="Page Blank">{{trans('admin.categories')}}</span></a>
                    </li>
                    <li {!! str_contains(route('featureIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('featureIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('featureIndex',app()->getLocale())}}"><i class="material-icons">star_border</i><span data-i18n="Page Blank">{{trans('admin.features')}}</span></a>
                    </li>
                    <li {!! str_contains(route('answerIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('answerIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('answerIndex',app()->getLocale())}}"><i class="material-icons">question_answer</i><span data-i18n="Page Blank">{{trans('admin.answers')}}</span></a>
                    </li>
                    <li {!! str_contains(route('saleIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('saleIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('saleIndex',app()->getLocale())}}"><i class="material-icons">money</i><span data-i18n="Page Blank">{{trans('admin.sales')}}</span></a>
                    </li>
                </ul>
            </div>
        </li>



        <li class="{{str_contains(route('userIndex',app()->getLocale()),request()->path()) || str_contains(route('subscriberIndex',app()->getLocale()),request()->path()) ?'active':''}} bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">person</i><span class="menu-title" data-i18n="Pages">{{trans('admin.customers')}}</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li {!! str_contains(route('userIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('userIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('userIndex',app()->getLocale())}}"><i class="material-icons">face</i><span data-i18n="Page Blank">{{trans('admin.users')}}</span></a>
                    </li>
                    <li {!! str_contains(route('subscriberIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('subscriberIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('subscriberIndex',app()->getLocale())}}"><i class="material-icons">mail</i><span data-i18n="Page Blank">{{trans('admin.subscribers')}}</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="{{str_contains(route('pageIndex',app()->getLocale()),request()->path()) || str_contains(route('sliderIndex',app()->getLocale()),request()->path()) || str_contains(route('settingIndex',app()->getLocale()),request()->path()) ?'active':''}} bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">settings</i><span class="menu-title" data-i18n="Pages">{{trans('admin.web_settings')}}</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li {!! str_contains(route('pageIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('pageIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('pageIndex',app()->getLocale())}}"><i class="material-icons">dashboard</i><span data-i18n="Page Blank">{{trans('admin.pages')}}</span></a>
                    </li>
                    <li {!! str_contains(route('sliderIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('sliderIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('sliderIndex',app()->getLocale())}}"><i class="material-icons">slideshow</i><span data-i18n="Page Blank">{{trans('admin.sliders')}}</span></a>
                    </li>
                    <li {!! str_contains(route('settingIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('settingIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('settingIndex',app()->getLocale())}}"><i class="material-icons">settings</i><span data-i18n="Page Blank">{{trans('admin.settings')}}</span></a>
                    </li>
                </ul>
            </div>
        </li>




        <li class="{{str_contains(route('hTagIndex',app()->getLocale()),request()->path()) ?'active':''}} bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">filter_tilt_shift</i><span class="menu-title" data-i18n="Pages">{{trans('admin.seo')}}</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li {!! str_contains(route('hTagIndex',app()->getLocale()),request()->path())?'class="active"':'' !!}><a {!! str_contains(route('hTagIndex',app()->getLocale()),request()->path())?'class="active"':'' !!} href="{{route('hTagIndex',app()->getLocale())}}"><i class="material-icons">check</i><span data-i18n="Page Blank">{{trans('admin.h_tags')}}</span></a>
                    </li>
                </ul>
            </div>
        </li>



        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('orderIndex',app()->getLocale()),request()->path())?"active":""}}"
                href="{{route('orderIndex',app()->getLocale())}}"><i class="material-icons dp48">add_shopping_cart</i><span>{{trans('admin.orders')}}</span></a>
        </li>

        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('blogIndex',app()->getLocale()),request()->path())?"active":""}}"
                href="{{route('blogIndex',app()->getLocale())}}"><i class="material-icons dp48">chrome_reader_mode</i><span>{{trans('admin.blog')}}</span></a>
        </li>

        <li class="bold"><a
                class="waves-effect waves-cyan {{str_contains(route('shipping.index',app()->getLocale()),request()->path())?"active":""}}"
                href="{{route('shipping.index',app()->getLocale())}}"><i class="material-icons dp48">chrome_reader_mode</i><span>{{trans('admin.shipping')}}</span></a>
        </li>

    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
       href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
