@extends('layouts.base')

{{--@dd($category)--}}

@section('head')
    <title>{{count($product->availableLanguage)>0?$product->availableLanguage[0]->meta_title:""}}</title>
    <meta name="description" content="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->meta_description:""}}">
    <meta name="keywords" content="{{count($product->availableLanguage)>0?$product->availableLanguage[0]->meta_keyword:""}}">
    {!! jsonld('product',[
            '@context'    => 'https://schema.org/',
            '@type'       => 'Product',
            'name'        => (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : '',
            'description' => (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->description : '',
            'url'         => route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug:null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug:null]),
        ])  !!}

    {!! jsonld('breadcrumb_list',[
            '@context'    => 'https://schema.org/',
            '@type'       => 'BreadcrumbList',
            'itemListElement'         => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => __('home'),
                    'item' => route('welcome')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => count($category->availableLanguage)>0?$category->availableLanguage[0]->title:"",
                    'item' => route('proxy',[app()->getLocale(),count($category->availableLanguage)>0?$category->availableLanguage[0]->slug:""])
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : '',
                    'name' => count($category->availableLanguage)>0?$category->availableLanguage[0]->title:"",
                    'item' => route('proxy',[app()->getLocale(),count($category->availableLanguage)>0?$category->availableLanguage[0]->slug:""])

                ],
            ],
        ])  !!}

    <link rel="canonical" href="{{route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug:null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug:null])}}" />
@endsection


@section('content')
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took">
                <a href="{{route('welcome')}}">@lang('client.home')</a> / <a href="{{route('proxy',[app()->getLocale(),count($category->availableLanguage)>0?$category->availableLanguage[0]->slug:""])}}">{{count($category->availableLanguage)>0?$category->availableLanguage[0]->title:""}}</a>
            </div>
            <div class="current">{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</div>
        </div>
    </section>

    <section class="product_full_view wrapper flex">
        <div class="flex responsive">
            @if(isset($product->files[0]))

                <div class="slider">
                    <div class="vertical_slider_view">
                        @foreach($product->files as $file)
                            <div class="fullview_slider_item active">
                                <img
                                    src="/storage/product/{{$file->fileable_id}}/thumb/{{$file->name}}"
                                    alt="{{count($file->availableLanguage)>0?$file->availableLanguage[0]->title:""}}"/>
                            </div>
                        @endforeach
                    </div>
                    <button class="arrow" id="arrow_slide_up">
                        <img src="/img/icons/slider/next.png" alt=""/>
                    </button>
                    <button class="arrow" id="arrow_slide_down">
                        <img src="/img/icons/slider/next.png" alt=""/>
                    </button>
                </div>


                <div class="large_view">
                    @foreach($product->files as $key=>$file)
                    <div class="magnified_img {{$key==0?"display":""}}">
                         <img
                            class="large_image_view "
                            src="/storage/product/{{$file->fileable_id}}/{{$file->name}}"
                            alt="{{count($file->availableLanguage)>0?$file->availableLanguage[0]->title:""}}"
                        />
                    </div>

                    @endforeach
                </div>
                <div class="loupe"></div>
            @else
                <div class="slider">
                    <div class="vertical_slider_view">
                        <div class="fullview_slider_item active">
                            <img
                                src="/noimage.png"
                                alt=""/>
                        </div>

                    </div>
                    <button class="arrow" id="arrow_slide_up">
                        <img src="/img/icons/slider/next.png" alt=""/>
                    </button>
                    <button class="arrow" id="arrow_slide_down">
                        <img src="/img/icons/slider/next.png" alt=""/>
                    </button>
                </div>
                <div class="large_view">
                    <img
                        class="large_image_view display"
                        src="/noimage.png"
                        alt=""
                    />
                    {{--                <img class="large_image_view" src="/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}" alt=""/>--}}
                    {{--                <img class="large_image_view" src="img/products/3.png" alt=""/>--}}
                    {{--                <img class="large_image_view" src="img/products/1.png" alt=""/>--}}
                    {{--                <img class="large_image_view" src="img/products/5.png" alt=""/>--}}
                    {{--                <img class="large_image_view" src="img/products/6.png" alt=""/>--}}
                </div>
            @endif
        </div>

        <div class="customize" id="customize-details">
            <{{isset($htags['product']->details) ? $htags['product']->details : 'div'}}
                class="product_name roboto">{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</{{isset($htags['product']->details) ? $htags['product']->details : 'div'}}>
            <p><span>ID:</span> {{$product->id}}</p>
            <p>
                <span>Category:</span> {{(count($category->availableLanguage)> 0) ? $category->availableLanguage[0]->title : ''}}
            </p>
            <div class="prices flex">
                @if($product->saleProduct && $product->saleProduct->sale)
                    <div class="main">
                        ₾ {{\App\Models\Product::calculatePrice($product->price,$product->saleProduct->sale->discount,$product->saleProduct->sale->type)}}</div>
                    <div class="last">$ {{round($product->price/100,2)}}</div>
                    <div class="off">
                        @if($product->saleProduct->sale->type=="percent")
                            -{{$product->saleProduct->sale->discount}}%
                        @else
                            -{{round(($product->saleProduct->sale->discount*100)/($product->price/100))}} %
                        @endif
                    </div>
                @else
                    <div class="main">₾ {{round($product->price/100,2)}}</div>
                @endif
            </div>

            {{--            <div class="colors">--}}
            {{--                <div class="title">Color</div>--}}
            {{--                <button--}}
            {{--                    class="color picked"--}}
            {{--                    style="background-color: #faeadb"--}}
            {{--                ></button>--}}
            {{--                <button class="color" style="background-color: #fbfebd"></button>--}}
            {{--                <button class="color" style="background-color: #dbfafa"></button>--}}
            {{--                <button class="color" style="background-color: #fadbe7"></button>--}}
            {{--            </div>--}}
            {{--            --}}

            {{--@dd($htags)--}}
            <?php $isFeature = false ?>
            {{--@dd($productFeatures,count($productFeatures[1]->feature->englishLanguage))--}}
            {{--@dd(count($productFeatures[1]->feature->englishLanguage))--}}
            @foreach($productFeatures as $productAnswer)
                @if($productAnswer->feature->type === 'input' || (count($productAnswer->feature->englishLanguage)>0?$productAnswer->feature->englishLanguage[0]->title=="category":""))
                    @continue
                @endif

            @if($productAnswer->feature->type === 'select')
                        <div class="options">
                            <div  class="title select">{{(count($productAnswer->feature->availableLanguage) > 0) ?  $productAnswer->feature->availableLanguage[0]->title : ''}}</div>
                            <select data-feature="{{$productAnswer->feature->id}}" name="popup-feature[{{$productAnswer->feature->id}}][]" id="details-{{$productAnswer->feature->id}}" >
                                        <option value=""></option>
                                @foreach($productAnswer->feature->answer as $answer)
                                    @if($answer->status && (in_array($answer->id,$productAnswers)))

                                        <option value="{{$answer->id}}">{{count($answer->availableLanguage)>0?$answer->availableLanguage[0]->title:""}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
            @else
                        <div class="options">
                            <div
                                class="title radio">{{(count($productAnswer->feature->availableLanguage) > 0) ?  $productAnswer->feature->availableLanguage[0]->title : ''}}</div>
                            <div class="box_grid">
                                @foreach($productAnswer->feature->answer as $answer)
                                    @if($answer->status && (in_array($answer->id,$productAnswers)))
                                        {{--@if()--}}
                                        <div class="box">
                                            <input type="radio" name="popup-feature[{{$productAnswer->feature->id}}][]"
                                                   data-feature="{{$productAnswer->feature->id}}" id="details-{{$answer->id}}"
                                                   value="{{$answer->id}}"/>
                                            <label for="details-{{$answer->id}}"
                                                   class="box">{{count($answer->availableLanguage)>0?$answer->availableLanguage[0]->title:""}}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
            @endif





            @endforeach
            <div class="btns flex">
                <div class="number_input">
                    <button class="decrease" onclick="decreaseValue('details')">-</button>
                    <input disabled id="product_numb" type="text" class="number" value="1"/>
                    <button class="increase" onclick="increaseValue('details')">+</button>
                </div>

                <button
                    {{--{{count($productAnswers)>0?"disabled":""}}--}} onclick="addToCartProductDetails(this, '{{$product->id}}')"
                    class="add_to_cart">
                    <img src="/img/icons/details/cart.png" alt=""/>
                    <div>{{__('client.add_to_cart')}}</div>
                </button>
            </div>
            <div class="product_added flex"> <span>{{__('client.product_added')}}</span>    <img src="/img/icons/details/added.png" alt=""/></div>
        </div>
    </section>
    <section class="information_section">
        <div class="heads">
            <div class="info_head clicked">@lang('client.description')</div>
            <div class="info_head">@lang('client.add_info')</div>
            <div class="info_head">@lang('client.ship_returns')</div>
        </div>
        <div class="information_content wrapper clicked">
            {{--            <div class="title">Product Information</div>--}}
            <p class="para">
{{--                @dd($product->availableLanguage[0]->short_description)--}}
                {!! (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->description : ''!!}

            </p>
        </div>
        <div class="information_content wrapper">
            {{--            <div class="title">Additional Information</div>--}}
            {!! (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->short_description : '' !!}

        </div>
        <div class="information_content wrapper">
            {!! (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->shipping : '' !!}
        </div>
    </section>
    @include('pages.best-sellers.index')
@endsection
