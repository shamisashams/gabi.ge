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
                <svg
                    id="shopping-cart"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                >
                    <rect
                        id="Rectangle_5"
                        data-name="Rectangle 5"
                        width="24"
                        height="24"
                        opacity="0"
                    />
                    <path
                        id="Path_3"
                        data-name="Path 3"
                        d="M21.08,7a2,2,0,0,0-1.7-1H6.58L6,3.74A1,1,0,0,0,5,3H3A1,1,0,0,0,3,5H4.24L7,15.26A1,1,0,0,0,8,16h9a1,1,0,0,0,.89-.55l3.28-6.56A2,2,0,0,0,21.08,7Zm-4.7,7H8.76L7.13,8H19.38Z"
                    />
                    <circle
                        id="Ellipse_1"
                        data-name="Ellipse 1"
                        cx="1.5"
                        cy="1.5"
                        r="1.5"
                        transform="translate(6 18)"
                    />
                    <circle
                        id="Ellipse_2"
                        data-name="Ellipse 2"
                        cx="1.5"
                        cy="1.5"
                        r="1.5"
                        transform="translate(16 18)"
                    />
                </svg>
                <div id="cart-count">0 / $0.00</div>
                <div class="cart_dropdown">

                </div>
            </div>
            @guest
                <a href="{{route('loginViewFront')}}" class="links">
                    <svg
                        id="person"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            id="Rectangle_74"
                            data-name="Rectangle 74"
                            width="24"
                            height="24"
                            opacity="0"
                        />
                        <path
                            id="Path_15"
                            data-name="Path 15"
                            d="M12,11A4,4,0,1,0,8,7,4,4,0,0,0,12,11Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,5Z"
                        />
                        <path
                            id="Path_16"
                            data-name="Path 16"
                            d="M12,13a7,7,0,0,0-7,7,1,1,0,0,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,7,7,0,0,0-7-7Z"
                        />
                    </svg>

                    <a href="{{route('loginViewFront')}}">
                        <div>{{__('client.login')}} / {{__('client.sign_up')}}</div>
                    </a>
                </a>
            @else
                <a href="{{route('profile',app()->getLocale())}}" class="links" style="margin-right: -10px;">
                    <svg
                        id="person"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            id="Rectangle_74"
                            data-name="Rectangle 74"
                            width="24"
                            height="24"
                            opacity="0"
                        />
                        <path
                            id="Path_15"
                            data-name="Path 15"
                            d="M12,11A4,4,0,1,0,8,7,4,4,0,0,0,12,11Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,5Z"
                        />
                        <path
                            id="Path_16"
                            data-name="Path 16"
                            d="M12,13a7,7,0,0,0-7,7,1,1,0,0,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,7,7,0,0,0-7-7Z"
                        />
                    </svg>
                    {{auth()->user()->name}}
                </a>
                <a href="{{route('logoutFront',app()->getLocale())}}" class="links">{{__('client.log_out')}}</a>
            @endguest
            <div class="links languages">
                <svg
                    id="shopping-cart"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                >
                    <defs>
                        <clipPath id="clip-path">
                            <rect
                                id="Rectangle_5"
                                data-name="Rectangle 5"
                                width="24"
                                height="24"
                                opacity="0"
                            />
                        </clipPath>
                    </defs>
                    <g
                        id="Mask_Group_2"
                        data-name="Mask Group 2"
                        clip-path="url(#clip-path)"
                    >
                        <g id="Layer_2" data-name="Layer 2">
                            <g id="globe">
                                <rect
                                    id="Rectangle_150"
                                    data-name="Rectangle 150"
                                    width="24"
                                    height="24"
                                    transform="translate(24 24) rotate(180)"
                                    opacity="0"
                                />
                                <path
                                    id="Path_19"
                                    data-name="Path 19"
                                    d="M22,12A10,10,0,1,0,12,22,10,10,0,0,0,22,12Zm-2.07-1H17a12.91,12.91,0,0,0-2.33-6.54A8,8,0,0,1,19.93,11ZM9.08,13H15a11.44,11.44,0,0,1-3,6.61A11,11,0,0,1,9.08,13Zm0-2A11.4,11.4,0,0,1,12,4.4,11.19,11.19,0,0,1,15,11Zm.36-6.57A13.18,13.18,0,0,0,7.07,11h-3A8,8,0,0,1,9.44,4.43ZM4.07,13h3a12.86,12.86,0,0,0,2.35,6.56A8,8,0,0,1,4.07,13Zm10.55,6.55A13.14,13.14,0,0,0,17,13h2.95A8,8,0,0,1,14.62,19.55Z"
                                />
                            </g>
                        </g>
                    </g>
                </svg>

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

    <button class="menu_btn"></button>
</header>
