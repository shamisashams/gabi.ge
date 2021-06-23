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
                    <a class="category_name" href="{{route('catalogue',[app()->getLocale(),$category->id])}}" style="overflow-wrap: anywhere">
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
                <a href="#" class="see_more">{{__('client.see_more')}}</a>
            </div>
            <div class="product_grid">
                @foreach($discountedProducts as $product)
                    <a href="{{route('productDetails',[app()->getLocale(),$product->category_id,$product->id])}}">
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
                                    class="title"><span style="overflow-wrap: break-word">
                                    {{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}
                                    </span>
                                </div>
                                <div
                                    class="sub roboto">{{count($product->availableLanguage)>0?$product->availableLanguage[0]->description:""}}</div>
                            </div>
                            <div>
                                @if($product->saleProduct && $product->saleProduct->sale)
                                    <div class="title price">
                                        ${{\App\Models\Product::calculatePrice($product->price,$product->saleProduct->sale->discount,$product->saleProduct->sale->type)}}
                                    </div>
                                    <div class="discount">${{round($product->price/100,2)}}</div>
                                @else
                                    <div class="title price">${{round($product->price/100,2)}}  </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    </a>
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
                <div  class="main_product_view">
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
                        <a>
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
                            @if($product->saleProduct && $product->saleProduct->sale)
                                <div class="title price">
                                    ${{\App\Models\Product::calculatePrice($product->price,$product->saleProduct->sale->discount,$product->saleProduct->sale->type)}}
                                </div>
                                <div class="discount">${{round($product->price/100,2)}}</div>
                            @else
                                <div class="title price">${{round($product->price/100,2)}}  </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div id="popup_bg" class="popup_bg flex center">
        <div class="product_popup">
            <div class="head flex">
                <div>Floral Print Dress Blue</div>
                <button class="close_popup">
                    <img src="/img/icons/popup/close.png" alt="" />
                </button>
            </div>
            <div class="flex content">
                <div class="imges">
                    <div class="main flex center">
                        <img class="main_img_popup" src="img/products/2.png" alt="" />
                    </div>
                    <div class="flex small0nes">
                        <div class="small_img_popup flex center">
                            <img src="img/products/2.png" alt="" />
                        </div>
                        <div class="small_img_popup flex center">
                            <img src="img/products/2.png" alt="" />
                        </div>
                        <div class="small_img_popup flex center">
                            <img src="img/products/2.png" alt="" />
                        </div>
                        <div class="small_img_popup flex center">
                            <img src="img/products/2.png" alt="" />
                        </div>
                    </div>
                </div>
                <div class="customize">
                    <div class="prices flex">
                        <div class="main">$150.80</div>
                        <div class="last">$150.80</div>
                        <div class="off">-40%</div>
                    </div>
                    <p><span>SKU:</span> 71236-1</p>
                    <p><span>Category:</span> Category 1, Category 2</p>
                    <div class="btns flex">
                        <div class="number_input">
                            <button class="decrease" onclick="decreaseValue()">-</button>
                            <input
                                id="product_number"
                                type="text"
                                class="number"
                                value="1"
                            />
                            <button class="increase" onclick="increaseValue()">+</button>
                        </div>
                    </div>
                    <div class="options">
                        <div class="title">Color</div>
                        <div class="box_grid">
                            <div class="box">
                                <input type="radio" name="color" id="color1" />
                                <label for="color1" class="box">Color1</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="color" id="color2" />
                                <label for="color2" class="box">Color2</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="color" id="color3" />
                                <label for="color3" class="box">Color3</label>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <div class="title">Size</div>
                        <div class="box_grid">
                            <div class="box">
                                <input type="radio" name="size" id="size1" />
                                <label for="size1" class="box">52 CM</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="size" id="size2" />
                                <label for="size2" class="box">52 CM</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="size" id="size3" />
                                <label for="size3" class="box">52 CM</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="size" id="size4" />
                                <label for="size4" class="box">52 CM</label>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <div class="title">Age</div>
                        <div class="box_grid">
                            <div class="box">
                                <input type="radio" name="age" id="age1" />
                                <label for="age1" class="box">3 - 6 Months</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="age" id="age2" />
                                <label for="age2" class="box">3 - 6 Months</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="age" id="age3" />
                                <label for="age3" class="box">3 - 6 Months</label>
                            </div>
                            <div class="box">
                                <input type="radio" name="age" id="age4" />
                                <label for="age4" class="box">3 - 6 Months</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex center btm_btns">
                <a href="#">
                    <button class="details">Detiles</button>
                </a>
                <a href="#">
                    <button class="add_to_cart flex center popup_add_to_cart">
                        <img src="img/icons/header/cart.png" alt="" />
                        <div>Add To Card</div>
                    </button>
                </a>
            </div>
            <div class="success flex center popup_success">
                <img src="/img/icons/popup/success.png" alt="">
                <div>Lorem Ipsum</div>
            </div>
        </div>
    </div>
@endsection
