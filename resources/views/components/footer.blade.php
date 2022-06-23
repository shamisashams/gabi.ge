<footer class="footer">
    <div class="footer_content wrapper flex">
        <div>
            <a class="logo" href="#">
                <img src="/img/logo/2.png" alt="" />
            </a>
            <p class="para">
                @lang('client.footer_text')
            </p>
            <div class="social_media">
                @if($siteFacebook)
                <a href="{{$siteFacebook}}" class="sm">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M288,176v-64c0-17.664,14.336-32,32-32h32V0h-64c-53.024,0-96,42.976-96,96v80h-64v80h64v256h96V256h64l32-80H288z"/>
                            </g>
                        </g>
                    </svg>
                </a>
                @endif
                @if($siteInstagram)
                <a href="{{$siteInstagram}}" class="sm">
                    <svg height="511pt" viewBox="0 0 511 511.9" width="511pt" xmlns="http://www.w3.org/2000/svg"><path d="m510.949219 150.5c-1.199219-27.199219-5.597657-45.898438-11.898438-62.101562-6.5-17.199219-16.5-32.597657-29.601562-45.398438-12.800781-13-28.300781-23.101562-45.300781-29.5-16.296876-6.300781-34.898438-10.699219-62.097657-11.898438-27.402343-1.300781-36.101562-1.601562-105.601562-1.601562s-78.199219.300781-105.5 1.5c-27.199219 1.199219-45.898438 5.601562-62.097657 11.898438-17.203124 6.5-32.601562 16.5-45.402343 29.601562-13 12.800781-23.097657 28.300781-29.5 45.300781-6.300781 16.300781-10.699219 34.898438-11.898438 62.097657-1.300781 27.402343-1.601562 36.101562-1.601562 105.601562s.300781 78.199219 1.5 105.5c1.199219 27.199219 5.601562 45.898438 11.902343 62.101562 6.5 17.199219 16.597657 32.597657 29.597657 45.398438 12.800781 13 28.300781 23.101562 45.300781 29.5 16.300781 6.300781 34.898438 10.699219 62.101562 11.898438 27.296876 1.203124 36 1.5 105.5 1.5s78.199219-.296876 105.5-1.5c27.199219-1.199219 45.898438-5.597657 62.097657-11.898438 34.402343-13.300781 61.601562-40.5 74.902343-74.898438 6.296876-16.300781 10.699219-34.902343 11.898438-62.101562 1.199219-27.300781 1.5-36 1.5-105.5s-.101562-78.199219-1.300781-105.5zm-46.097657 209c-1.101562 25-5.300781 38.5-8.800781 47.5-8.601562 22.300781-26.300781 40-48.601562 48.601562-9 3.5-22.597657 7.699219-47.5 8.796876-27 1.203124-35.097657 1.5-103.398438 1.5s-76.5-.296876-103.402343-1.5c-25-1.097657-38.5-5.296876-47.5-8.796876-11.097657-4.101562-21.199219-10.601562-29.398438-19.101562-8.5-8.300781-15-18.300781-19.101562-29.398438-3.5-9-7.699219-22.601562-8.796876-47.5-1.203124-27-1.5-35.101562-1.5-103.402343s.296876-76.5 1.5-103.398438c1.097657-25 5.296876-38.5 8.796876-47.5 4.101562-11.101562 10.601562-21.199219 19.203124-29.402343 8.296876-8.5 18.296876-15 29.398438-19.097657 9-3.5 22.601562-7.699219 47.5-8.800781 27-1.199219 35.101562-1.5 103.398438-1.5 68.402343 0 76.5.300781 103.402343 1.5 25 1.101562 38.5 5.300781 47.5 8.800781 11.097657 4.097657 21.199219 10.597657 29.398438 19.097657 8.5 8.300781 15 18.300781 19.101562 29.402343 3.5 9 7.699219 22.597657 8.800781 47.5 1.199219 27 1.5 35.097657 1.5 103.398438s-.300781 76.300781-1.5 103.300781zm0 0"/><path d="m256.449219 124.5c-72.597657 0-131.5 58.898438-131.5 131.5s58.902343 131.5 131.5 131.5c72.601562 0 131.5-58.898438 131.5-131.5s-58.898438-131.5-131.5-131.5zm0 216.800781c-47.097657 0-85.300781-38.199219-85.300781-85.300781s38.203124-85.300781 85.300781-85.300781c47.101562 0 85.300781 38.199219 85.300781 85.300781s-38.199219 85.300781-85.300781 85.300781zm0 0"/><path d="m423.851562 119.300781c0 16.953125-13.746093 30.699219-30.703124 30.699219-16.953126 0-30.699219-13.746094-30.699219-30.699219 0-16.957031 13.746093-30.699219 30.699219-30.699219 16.957031 0 30.703124 13.742188 30.703124 30.699219zm0 0"/></svg>
                </a>
                @endif
            </div>
        </div>
        <div>
            <?php
            $path = request()->path();
            $path = explode('/',$path);
            $slug = end($path);
            $slug = urldecode($slug);
            //echo $slug;
            ?>
            <div class="title">@lang('client.footer_nav_title1')</div>
            <a href="{{route('welcome')}}" class="link {{str_contains(substr(parse_url(route('welcome',app()->getLocale()), PHP_URL_PATH), 1),request()->path())?"active":""}}">{{__('client.home')}}</a>
            <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['contact-us']['slug']) ? $page_slugs['contact-us']['slug'] : null])}}"
               class="link {{($slug == (isset($page_slugs['contact-us']['slug']) ? $page_slugs['contact-us']['slug'] : null))?"active":""}}">{{__('client.contact_us')}}</a>
            <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['about-us']['slug']) ? $page_slugs['about-us']['slug'] : null])}}"
               class="link {{($slug == (isset($page_slugs['about-us']['slug']) ? $page_slugs['about-us']['slug'] : null)) ?"active":""}}">{{__('client.about_us')}}</a>
            <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['helps']['slug']) ? $page_slugs['helps']['slug'] : null])}}"
               class="link {{($slug == (isset($page_slugs['helps']['slug']) ? $page_slugs['helps']['slug'] : null))?"active":""}}">{{__('client.helps')}}</a>
                <a href="{{route('proxy',[app()->getLocale(),isset($page_slugs['blogs']['slug']) ? $page_slugs['blogs']['slug'] : null])}}"
                   class="link {{($slug == (isset($page_slugs['blogs']['slug']) ? $page_slugs['blogs']['slug'] : null))?"active":""}}">{{__('client.blogs')}}</a>
        </div>
        <div>
            <div class="title">@lang('client.footer_nav_title2')</div>
            @foreach($categories as $key=>$category)
                <a class="link" href="{{route('proxy',[app()->getLocale(),count($category->availableLanguage) > 0 ? $category->availableLanguage[0]->slug : null])}}">
                    {{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}
                </a>
                @if($loop->iteration > 4)
                    @break
                @endif
            @endforeach

        </div>
        <div>
            <div class="title last">
                @lang('client.footer_text2')
            </div>
            <p class="para last">
                @lang('client.footer_text3')
            </p>
            <div class="email">
                <input id="sb_inp" type="email " placeholder="@lang('client.enter_email')" />
                <button id="sb_btn" class="ok roboto">@lang('client.ok')</button>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="wrapper flex">
            <div class="design">Design By Insite Internation</div>
            <div class="banks">
                <a href="#">
                    <img src="/img/banks/1.png" alt="" />
                </a>
                <a href="#">
                    <img src="/img/banks/2.png" alt="" />
                </a>
            </div>
        </div>
    </div>
    <div class="subscribe_popup_bg"></div>
    <div class="subscribe_popup ">
        <div class="flex center">
            <img src="/img/icons/tick.png" alt="" />
            <div>Success!</div>
        </div>
        <button id="close_subscribe">OK</button>
    </div>
</footer>

@push('script')
    <script>
        let locale_f = $('meta[name="language"]').attr("content");
        $('#sb_btn').click(function (e){
            let val = $('#sb_inp').val();
            //console.log($('meta[name="csrf-token"]').attr("content"))
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: `/${locale_f}/subscribe/`,
                method: "post",
                data: { email: val },
                success: function (data) {
                    console.log(data)
                    alert('ok')
                },
                error: function (data){
                    console.log(data)
                    if(data.hasOwnProperty('responseJSON')) alert(data.responseJSON.message);
                }
            });
        });
    </script>
@endpush
