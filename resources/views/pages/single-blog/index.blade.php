@extends('layouts.base')
@section('head')
    <title>{{count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($blog->availableLanguage)>0?$blog->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($blog->availableLanguage)>0?$blog->availableLanguage[0]->meta_keywords:""}}">
    <link rel="canonical" href="{{route('viewBlog',[app()->getLocale(),count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->slug : ''])}}" />

    {!! jsonld('breadcrumb_list',[
            '@context'    => 'https://schema.org/',
            '@type'       => 'BreadcrumbList',
            'itemListElement'         => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => __('client.home'),
                    'url' => route('welcome')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => count($blog->availableLanguage)>0?$blog->availableLanguage[0]->title:"",
                    'url' => route('viewBlog',[app()->getLocale(),count($blog->availableLanguage)>0?$blog->availableLanguage[0]->slug:""])
                ]
            ],
        ])  !!}

    @foreach($globalLanguages['data'] as $lang)
        @if($lang['abbreviation'] == app()->getLocale())
            @continue
        @endif
        <?php


        $language_id = App\Models\Language::getIdByName($lang['abbreviation']);

        $blo = App\Models\BlogLanguage::query()->where('blog_id',$blog->id)->where('language_id',$language_id)->first();


        ?>


        @if($blo)
            <link rel="alternate" hreflang="{{$lang['locale']}}" href="{{route('viewBlog',[$lang['abbreviation'],$blo->slug])}}" />
        @endif

    @endforeach
@endsection

@section('content')


    <section class="blogs_page single_blog wrapper">
        <div  class="showcase">
            <img src="{{asset($blog->firstImage ? ('storage/blog/' . $blog->firstImage->fileable_id .'/'. $blog->firstImage->name) : null)}}" alt="">
            <div class="showcase_innerbox flex center">
                <{{isset($htags['blog']->slider) ? $htags['blog']->details : 'div'}} class="bold">{{count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->title : ''}}</{{isset($htags['blog']->slider) ? $htags['blog']->details : 'div'}}>
                <p>{{count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->title_2 : ''}}</p>
            </div>
        </div>
        <div class="container">
            <div class="heading flex">
                <div class="shallow date">{{$blog->created_at}}</div>
                <div class="flex">
                    {{--<div class="flex center shallow">
                        <img src="/img/icons/blogs/share.svg" alt=""/>
                        <span>223</span>
                    </div>--}}
                    <div class="flex center shallow">
                        <img src="/img/icons/blogs/eye.svg" alt=""/>
                        <span>{{$blog->views}}</span>
                    </div>
                    <div class="flex center " style="color: #000;">
                        <img src="/img/icons/blogs/share2.svg" alt=""/>
                        <span >Share</span>
                    </div>
                </div>
            </div>
            <div class="content">

                {!! count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->text : '' !!}

                @if(isset($blog->files[1]))
                <img src="{{asset('storage/blog/' . $blog->files[1]->fileable_id . '/' . $blog->files[1]->name)}}" alt="">
                @endif
                {!! count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->text_2 : '' !!}
                @if(isset($blog->files[2]))
                    <img src="{{asset('storage/blog/' . $blog->files[2]->fileable_id . '/' . $blog->files[2]->name)}}" alt="">
                @endif
                {!! count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->text_3 : '' !!}
            </div>
            <div class="flex center " style="color: #000;">
                    <img style="margin-right: 8px" src="/img/icons/blogs/share2.svg" alt=""/>
                    <span >Share</span>
                </div>
        </div>
     <div style="color: #000;">  You may like</div>
        <div class="blog_grid">
            @foreach($blogs as $blog)
            <a href="{{route('viewBlog',[app()->getLocale(),count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->slug : ''])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="{{asset($blog->firstImage ? ('storage/blog/' . $blog->firstImage->fileable_id .'/'. $blog->firstImage->name) : null)}}" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">{{count($blog->availableLanguage) > 0 ? $blog->availableLanguage[0]->title : ''}}</div>
                        <div class="date shallow">{{$blog->created_at}}</div>
                    </div>
                    <div>
                        {{--<div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>--}}
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>{{$blog->views}}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

        </div>

    </section>


@endsection
