@extends('layouts.base')
@section('head')
    <title>{{__('app.title_home')}} - {{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}</title>
@endsection

@section('content')
    <style>
        /* Customize the label (the container) */
        .container {
            display: block;
            position: relative;
            padding-left: 25px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 14px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 18px;
            width: 18px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 7px;
            top: 4px;
            width: 5px;
            height: 8px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome',app()->getLocale())}}">Home</a>
                / {{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}</div>
            <div
                class="current">{{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}</div>
        </div>
    </section>
    <section class="product_content_section wrapper flex">
        <form action="{{route('catalogue',[app()->getLocale(),$category->id])}}" style="display: contents">
            <div class="sidebar_filters">
                <div class="section">
                    <div class="titles">{{__('client.price_filter')}}</div>
                    <p>
                        {{__('client.price')}}: <label for="min">₾{{Request::get('min_price')}}</label> — <label
                            for="max">₾{{Request::get('max_price')}}</label>
                    </p>
                    <div class="price_control">
                        <input id="min" name="min_price" type="text" value="{{Request::get('min_price')}}"/>
                        <input id="max" name="max_price" type="text" value="{{Request::get('max_price')}}"/>
                        <button class="ok">Ok</button>
                    </div>
                </div>
                @foreach($productFeatures as $productAnswer)
                    <div class="section">
                        <div
                            class="titles">{{count($productAnswer->feature->availableLanguage)>0?$productAnswer->feature->availableLanguage[0]->title:""}}</div>
                        @foreach($productAnswer->feature->answer as $answer)
                            @if(in_array($answer->id,$productAnswers))
                                <div>
                                    <label class="container">
                                        {{count($answer->availableLanguage)>0?$answer->availableLanguage[0]->title:""}}
                                        <input type="checkbox" name="feature[{{$productAnswer->feature->id}}][]"
                                               onchange="this.form.submit()"
                                               value="{{$answer->id}}" @if(isset(Request::get('feature')[$productAnswer->feature->id]))
                                            {{in_array($answer->id,Request::get('feature')[$productAnswer->feature->id]) ? 'checked' : ''}}
                                            @endif>
                                        <span class="checkmark"></span>

                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
            <section class="products_viewport">
                <div class="product_grid">
                    @foreach($products as $product)
                        {{--                        <a href="{{route('productDetails',[app()->getLocale(),$category->id,$product->id])}}">--}}
                    {{--@dd($product)--}}
                        <div class="main_product_view">
                            <a href="{{route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug : null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug:null])}}">
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
                                             src="/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}"
                                             alt=""/>
                                    @else
                                        <img src="noimage.png"/>
                                    @endif
                                    <div class="on_hover_btns">
                                        <a class="view_popup_product">
                                            <button onclick="addToModal({{$product}})" type="button" class="add_to_cart view">
                                                <img src="/img/icons/profile/view.svg" alt=""/>
                                                <div class="roboto">{{__('client.view')}}</div>
                                            </button>
                                        </a>
                                        <a href="{{route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug: null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug:null])}}">
                                            <button type="button" class="add_to_cart details">
                                                <img src="/img/icons/profile/magnifying-glass.svg" alt=""/>
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
                                            ₾{{\App\Models\Product::calculatePrice($product->price,$product->saleProduct->sale->discount,$product->saleProduct->sale->type)}}
                                        </div>
                                        <div class="discount">₾{{round($product->price/100,2)}}</div>
                                    @else
                                        <div class="title price">₾{{round($product->price/100,2)}}  </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{--                        </a>--}}
                    @endforeach
                </div>

                {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
                <div class="page_input">
                    <input type="number" name="page" placeholder="Enter Page"/>
                    <button class="ok">Ok</button>
                </div>
            </section>
        </form>
    </section>

@endsection
