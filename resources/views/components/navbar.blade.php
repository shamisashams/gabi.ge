<header class="header wrapper">
    <a href="{{route('welcome',app()->getLocale())}}" class="logo logo_mobile"
    ><img src="/img/logo/obaby.png" alt=""
        /></a>
    <div class="header_content flex">
        <div class="flex columns">
            <a href="{{route('welcome',app()->getLocale())}}" class="logo"
            ><img src="/img/logo/obaby.png" alt=""
                /></a>
            <div class="navbar">
                <a href="{{route('welcome')}}"
                   class="nav_link {{str_contains(substr(parse_url(route('welcome',app()->getLocale()), PHP_URL_PATH), 1),request()->path())?"active":""}}">{{__('client.home')}}</a>
                <div class="nav_link">
                    {{__('client.categories')}}

                    <div class="category_dropdown">

                        <div>
                            @foreach($categories as $key=>$category)
                                <a href="{{route('proxy',[app()->getLocale(),count($category->availableLanguage)>0?$category->availableLanguage[0]->slug:null])}}">
                                    <div
                                        class="category_list {{$key==0?"active":""}}">{{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}</div>
                                </a>
                            @endforeach
                        </div>
                        <div style="height: 100%">
                            <div class="category_img_placeholder">
                                @foreach($categories as $key=>$category)
                                    <div class="category_img {{$key==0?"display":""}}">
                                        @if(isset($category->files[0]))
                                            <img class="main"
                                                 src="/storage/category/{{$category->files[0]->fileable_id}}/thumb/{{$category->files[0]->name}}"
                                                 alt="{{count($category->files[0]->availableLanguage)>0?$category->files[0]->availableLanguage[0]->title:""}}"/>
                                        @else
                                            <img src="/noimage.png"/>
                                        @endif
                                        <img src="/img/products/frame.png" alt="" class="frame"/>
                                        <a class="cat_btn"
                                           href="{{route('proxy',[app()->getLocale(),count($category->availableLanguage)>0?$category->availableLanguage[0]->slug:null])}}">{{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{--@dd(request()->path())--}}
                <?php
                $path = request()->path();
                $path = explode('/',$path);
                $slug = end($path);
                $slug = urldecode($slug);
                //echo $slug;
                ?>
                <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['contact-us']['slug']) ? $page_slugs['contact-us']['slug'] : null])}}"
                   class="nav_link {{($slug == (isset($page_slugs['contact-us']['slug']) ? $page_slugs['contact-us']['slug'] : null))?"active":""}}">{{__('client.contact_us')}}</a>
                <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['about-us']['slug']) ? $page_slugs['about-us']['slug'] : null])}}"
                   class="nav_link {{($slug == (isset($page_slugs['about-us']['slug']) ? $page_slugs['about-us']['slug'] : null)) ?"active":""}}">{{__('client.about_us')}}</a>
                <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['helps']['slug']) ? $page_slugs['helps']['slug'] : null])}}"
                   class="nav_link {{($slug == (isset($page_slugs['helps']['slug']) ? $page_slugs['helps']['slug'] : null))?"active":""}}">{{__('client.helps')}}</a>
                <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['blogs']['slug']) ? $page_slugs['blogs']['slug'] : null])}}"
                   class="nav_link {{($slug == (isset($page_slugs['blogs']['slug']) ? $page_slugs['blogs']['slug'] : null))?"active":""}}">{{__('client.blogs')}}</a>
            </div>
        </div>
        <div class="flex columns">
            <div class="links" id="cart_header">
                <a class="abs_link" href="{{route('cart',app()->getLocale())}}">|0 / $0.00|</a>
                <img width="18px"  src="/img/icons/header/cart.png" alt="">
                <div id="cart-count">0 / $0.00</div>
                <div class="cart_dropdown">

                </div>
            </div>
            @guest
                <a href="{{route('loginViewFront')}}" class="links account">
                    <img src="/img/icons/header/person.png" alt="">
                        <div>{{__('client.login')}} / {{__('client.sign_up')}}</div>
                </a>
            @else
                <a href="{{route('profile',app()->getLocale())}}" class="links account" >
                    <img src="/img/icons/header/person.png" alt="">
                    {{auth()->user()->name}}
                </a>
                <a href="{{route('logoutFront',app()->getLocale())}}" class="links" style="margin-right: 2px;">{{__('client.log_out')}}</a>
            @endguest
            <div class="links languages">
                <img width="18px"  src="/img/icons/header/globe.png" alt="">
                <div>{{$globalLanguages['current']['title']}}</div>
                <div class="dropdown">
                    @foreach($globalLanguages['data'] as $language)
                        @if($language['title']!==$globalLanguages['current']['title'])
                            <a href="{{$language['url']}}" class="lang">{{$language['title']}}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <button class="close_menu">
            <img src="/img/else/close.svg" alt=""/>
        </button>
    </div>

    <button class="menu_btn">
    <!-- {{__('client.menu_responsive_text')}} -->
    <img width="24px"  src="/img/icons/header/menu.png" alt="">
    </button>
</header>
