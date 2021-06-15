@extends('layouts.base')
@section('head')
    <title>{{__('app.title_home')}}</title>
@endsection

@section('content')
    <section class="hero wrapper">
        <div class="hero_slideshow">
            @foreach($sliders as $slider)
            <div class="slide slide1">
                @if(isset($slider->files[0]))
                <img src="/storage/slider/{{$slider->files[0]->fileable_id}}/{{$slider->files[0]->name}}" alt=""/>
                @else
                    <img src="noimage.png"/>
                @endif
                <div class="overlay">
                    <div class="hero_box">
                        <div class="new">{{count($slider->availableLanguage)>0?$slider->availableLanguage[0]->title:""}}</div>
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
                    <a class="category_name"
                       href="#"> {{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}} </a>
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
        <div class="left_bg">
            <img src="img/else/1.png" alt=""/>
            <img class="frame" src="img/else/frame2.png" alt=""/>
            <div class="overlay">
                <a href="#">
                    <button class="discount">{{__('client.discount')}}</button>
                </a>
            </div>
        </div>
        <section class="products_viewport">
            <div class="products_head flex">
                <div class="title">{{__('client.summer_discount')}}</div>
                <a href="#" class="see_more">{{__('client.see_more')}}</a>
            </div>
            <div class="product_grid">
                @foreach($discountedProducts as $product)
                    <div class="main_product_view">
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
                                     src="/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}"
                                     alt=""/>
                            @else
                                <img src="noimage.png"/>
                            @endif
                            <button class="add_to_cart">
                                <img src="img/icons/header/cart.png" alt=""/>
                                <div class="roboto">{{__('client.add_to_cart')}}</div>
                            </button>
                        </div>
                        <div class="detail flex">
                            <div>
                                <div
                                    class="title">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}</div>
                                <div
                                    class="sub roboto">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->description:""}}</div>
                            </div>
                            <div>
                                @if($product->saleProduct && $product->saleProduct->sale && $product->saleProduct->sale->type=="fixed")
                                    <div class="title price">
                                        ${{round(($product->price/100)-$product->saleProduct->sale->discount,2)}}</div>
                                    <div class="discount">$ {{round($product->price/100,2)}}</div>
                                @elseif($product->saleProduct && $product->saleProduct->sale && $product->saleProduct->sale->type=="percent")
                                    <div class="title price">
                                        ${{round(($product->price/100)-((($product->price/100)*$product->saleProduct->sale->discount)/100),2)}}</div>
                                    <div
                                        class="discount">$ {{round($product->price/100,2)}}</div>
                                @else
                                    <div class="title price">$ {{round($product->price/100,2)}}  </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </section>

    <section class="products_viewport wrapper">
        <div class="products_head flex">
            <div class="title">{{__('client.new_products')}}</div>
            <a href="#" class="see_more">{{__('client.see_more')}}</a>
        </div>
        <div class="arrows">
            <button id="next_np">
                <img src="img/icons/slider/next.png" alt=""/>
            </button>
        </div>
        <div class="flex new_products_slide">
            @foreach($newProducts as $product)
                <div class="main_product_view">
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
                                 src="/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}"
                                 alt=""/>
                        @else
                            <img src="noimage.png"/>
                        @endif
                        <a href="fullview.html">
                            <button class="add_to_cart">
                                <img src="img/icons/header/cart.png" alt=""/>
                                <div class="roboto">{{__('client.add_to_cart')}}</div>
                            </button>
                        </a>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div
                                class="title">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}</div>
                            <div
                                class="sub roboto">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->description:""}}</div>
                        </div>
                        <div>
                            @if($product->saleProduct && $product->saleProduct->sale && $product->saleProduct->sale->type=="fixed")
                                <div class="title price">
                                    ${{round(($product->price/100)-$product->saleProduct->sale->discount,2)}}</div>
                                <div class="discount">$ {{round($product->price/100,2)}}</div>
                            @elseif($product->saleProduct && $product->saleProduct->sale && $product->saleProduct->sale->type=="percent")
                                <div class="title price">
                                    ${{round(($product->price/100)-((($product->price/100)*$product->saleProduct->sale->discount)/100),2)}}</div>
                                <div
                                    class="discount">$ {{round($product->price/100,2)}}</div>
                            @else
                                <div class="title price">$ {{round($product->price/100,2)}}  </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
