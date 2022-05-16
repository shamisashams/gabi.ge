@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
@endsection
@section('description'){{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->description : null}}@endsection
@section('keywords'){{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->description : null}}@endsection
@section('content')


    <section class="blogs_page wrapper">
        <div class="showcase flex center">
            <div class="showcase_innerbox flex center">
                <div class="bold">BLOG</div>
                <p>Read the stories you love to know</p>
            </div>
        </div>
        <div class="blog_grid">
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/3.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/4.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/5.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/3.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/4.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/5.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="pagination flex center">
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
        </div>
    </section>


@endsection
