@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
    <meta name="description" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($page->availableLanguage)>0?$page->availableLanguage[0]->meta_keyword:""}}">
@endsection


@section('content')
    <section class="hero wrapper">
        <div class="hero_slideshow">
            @foreach($sliders as $slider)
                <div class="slide slide1">
                    @if(isset($slider->files[0]))
                        <img src="/storage/slider/{{$slider->files[0]->fileable_id}}/{{$slider->files[0]->name}}"
                             alt=""/>
                    @else
                        <img src="noimage.png"/>
                    @endif
                    <div class="overlay">
                        <div class="hero_box">
                            <div
                                class="new">{{count($slider->availableLanguage)>0?$slider->availableLanguage[0]->title:""}}</div>
                            <div class="title">
                            <span>
                            {{count($slider->availableLanguage)>0?$slider->availableLanguage[0]->description:""}}
                            </span>
                            </div>
                            <a href="{{$slider->redirect_url}}" target="_self">
                                <button class="hero_btn">{{__('client.see_collection')}}</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @include('pages.best-sellers.index')
    <section class="category_slider_container">
        <div class="category_slide">
            @foreach($categories as $category)
                <div class="category">
                    @if(isset($category->files[0]))
                        <img class="product"
                             src="/storage/category/{{$category->files[0]->fileable_id}}/{{$category->files[0]->name}}"
                             alt=""/>
                    @else
                        <img class="product" src="noimage.png"/>
                    @endif
                    <img class="frame" src="img/products/frame.png" alt=""/>
                    <a class="category_name" href="{{route('catalogueSeo',[app()->getLocale(),count($category->availableLanguage)>0 ? $category->availableLanguage[0]->slug:null])}}"
                       style="overflow-wrap: anywhere">
                        {{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}
                    </a>
                    <div class="overlay"></div>
                </div>
            @endforeach
        </div>
        <button class="cat_slide_btn cat_slide_btn_prev">
            <img src="img/icons/slider/arrow_l.png" alt=""/>
        </button>
        <button class="cat_slide_btn cat_slide_btn_next">
            <img src="img/icons/slider/arrow_l.png" alt=""/>
        </button>
    </section>

    <section class="summer_discount flex wrapper">
        @if($banner)
            <div class="left_bg">
                @if(isset($banner->files[0]))
                    <img src="/storage/slider/{{$banner->files[0]->fileable_id}}/{{$banner->files[0]->name}}" alt=""/>
                @else
                    <img src="noimage.png"/>
                @endif
                <img class="frame" src="img/else/frame2.png" alt=""/>
                <div class="overlay">
                    <a href="#">
                        <button
                            class="discount">
                            {{count($banner->availableLanguage)>0?$banner->availableLanguage[0]->title:""}}
                        </button>
                    </a>
                </div>
            </div>
        @endif
        <section class="products_viewport">
            <div class="products_head flex">
                <div class="title">{{__('client.summer_discount')}}</div>
                <a href="{{route('discount')}}" class="see_more">{{__('client.see_more')}}</a>
            </div>
            <div class="product_grid">
                @foreach($discountedProducts as $product)

                        <div class="main_product_view">
                            <a href="{{route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug : null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug : null])}}">
                            <div class="pic">
                                @if($product->saleProduct && $product->saleProduct->sale)
                                    <div class="label off">
                                        @if($product->saleProduct->sale->type=="percent")
                                            -{{$product->saleProduct->sale->discount}}%
                                        @else
                                            -{{round(($product->saleProduct->sale->discount*100)/($product->price/100))}}
                                            %
                                        @endif
                                    </div>
                                @endif
                                @if(isset($product->files[0]))
                                    <img class="p_img"
                                         src="/storage/product/{{$product->files[0]->fileable_id}}/thumb/{{$product->files[0]->name}}"
                                         alt="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}"/>
                                @else
                                    <img src="noimage.png"/>
                                @endif
                                    <div class="on_hover_btns">
                                        <a class="view_popup_product">
                                            <button onclick="addToModal({{$product}})" class="add_to_cart view">
                                                <img src="img/icons/profile/view.svg" alt="" />
                                                <div class="roboto">{{__('client.view')}}</div>
                                            </button>
                                        </a>
                                        <a href="{{route('productDetails',[app()->getLocale(),$product->category_id,$product->id])}}">
                                            <button class="add_to_cart details">
                                                <img src="/img/icons/profile/magnifying-glass.svg" alt="" />
                                                <div class="roboto">{{__('client.details')}}</div>
                                            </button>
                                        </a>
                                    </div>
                            </div>
                            </a>
                            <div class="detail flex">
                                <div>
                                    <div
                                        class="title"><span style="overflow-wrap: break-word">
                                    {{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}
                                    </span>
                                    </div>
                                    <div
                                        class="sub roboto">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->short_description:""}}</div>
                                </div>
                                <div>
                                    @if($product->saleProduct && $product->saleProduct->sale)
                                        <div class="title price">
                                            ₾{{\App\Models\Product::calculatePrice($product->price,$product->saleProduct->sale->discount,$product->saleProduct->sale->type)}}
                                        </div>
                                        <div class="discount">₾{{round($product->price/100,2)}}</div>
                                    @else
                                        <div class="title price">₾{{round($product->price/100,2)}}  </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </section>
    </section>

    <section class="products_viewport blog_section">
        <div class="wrapper">
            <div class="products_head ">
                <div class="title">Blog</div>
            </div>
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
            <div class="btn">

                <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['blogs']['slug']) ? $page_slugs['blogs']['slug'] : null])}}" class="view_all">View all</a>
            </div>
        </div>


    </section>
    <section class="products_viewport wrapper">
        <div class="products_head flex">
            <div class="title">{{__('client.new_products')}}</div>
            <a href="{{route('new')}}" class="see_more">{{__('client.see_more')}}</a>
        </div>
        <div class="arrows">
            <button id="next_np">
                <img src="img/icons/slider/next.png" alt=""/>
            </button>
        </div>
        <div class="flex new_products_slide">
            @foreach($newProducts as $product)
                <div class="main_product_view">
                    <a href="{{route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug : null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug : null])}}">
                    <div class="pic">
                        @if($product->saleProduct && $product->saleProduct->sale)
                            <div class="label off">
                                @if($product->saleProduct->sale->type=="percent")
                                    -{{$product->saleProduct->sale->discount}}%
                                @else
                                    -{{round(($product->saleProduct->sale->discount*100)/($product->price/100))}} %
                                @endif
                            </div>
                        @endif
                        @if(isset($product->files[0]))
                            <img class="p_img"
                                 src="/storage/product/{{$product->files[0]->fileable_id}}/thumb/{{$product->files[0]->name}}"
                                 alt="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}"/>
                        @else
                            <img src="noimage.png"/>
                        @endif
                            <div class="on_hover_btns">
                                <a class="view_popup_product">
                                    <button onclick="addToModal({{$product}})" class="add_to_cart view">
                                        <img src="/img/icons/profile/view.svg" alt="" />
                                        <div class="roboto">{{__('client.view')}}</div>
                                    </button>
                                </a>
                                <a href="{{route('productDetails',[app()->getLocale(),$product->category_id,$product->id])}}">
                                    <button class="add_to_cart details">
                                        <img src="/img/icons/profile/magnifying-glass.svg" alt="" />
                                        <div class="roboto">{{__('client.details')}}</div>
                                    </button>
                                </a>
                            </div>
                    </div>
                    </a>
                    <div class="detail flex">
                        <div>
                            <div
                                class="title">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}</div>
                            <div
                                class="sub roboto">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->short_description:""}}</div>
                        </div>
                        <div>
                            @if($product->saleProduct && $product->saleProduct->sale)
                                <div class="title price">
                                    ₾ ${{\App\Models\Product::calculatePrice($product->price,$product->saleProduct->sale->discount,$product->saleProduct->sale->type)}}
                                </div>
                                <div class="discount">₾{{round($product->price/100,2)}}</div>
                            @else
                                <div class="title price">₾{{round($product->price/100,2)}}  </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
