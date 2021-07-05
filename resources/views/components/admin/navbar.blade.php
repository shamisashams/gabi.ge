<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav
            class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
            <div class="nav-wrapper">

                <ul class="navbar-list right">
                    <li class="dropdown-language">
                        <a class="waves-effect waves-block waves-light translation-button" href="#"
                           data-target="translation-dropdown">
                            <span class="">
                                {{$globalLanguages['current']['title']}}
                            </span>
                        </a>
                    </li>

                    <li class="hide-on-med-and-down"><a
                            class="waves-effect waves-block waves-light toggle-fullscreen"
                            href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                           data-target="profile-dropdown"><span class="avatar-status avatar-online"><img
                                    src="/admin/images/avatar/avatar-7.png" alt="avatar"><i></i></span></a>
                    </li>
                </ul>
                <!-- translation-button-->
                <ul class="dropdown-content" id="translation-dropdown">
                    @foreach($globalLanguages['data'] as $language)
                        @if($language['title']!==$globalLanguages['current']['title'])
                            <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{$language['url']}}"
                                                         data-language="en"><i
                                        class=""></i>{{$language['title']}}</a></li>
                        @endif
                    @endforeach
                </ul>
                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">

                    <li><a class="grey-text text-darken-1" href="{{route('logout',app()->getLocale())}}"><i
                                class="material-icons">keyboard_tab</i>
                            Logout</a></li>
                </ul>
            </div>

        </nav>
    </div>
</header>
