@extends('layouts.base')


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
                    'name' => __('client.home'),
                    'url' => route('welcome')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => count($category->availableLanguage)>0?$category->availableLanguage[0]->title:"",
                    'url' => route('proxy',[app()->getLocale(),count($category->availableLanguage)>0?$category->availableLanguage[0]->slug:""])
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : '',
                    'name' => count($category->availableLanguage)>0?$category->availableLanguage[0]->title:"",
                    'url' => route('proxy',[app()->getLocale(),count($category->availableLanguage)>0?$category->availableLanguage[0]->slug:""])

                ],
            ],
        ])  !!}

    @if(isset($product->files[0]))
        <meta property="og:image" content="{{request()->getHttpHost()}}/storage/product/{{$product->files[0]->fileable_id}}/thumb/{{$product->files[0]->name}}" />
    @endif

    @foreach($globalLanguages['data'] as $lang)
        @if($lang['abbreviation'] == app()->getLocale())
            @continue
        @endif
        <?php


        $language_id = App\Models\Language::getIdByName($lang['abbreviation']);
        $prod = App\Models\ProductLanguage::query()->where('product_id',$product->id)->where('language_id',$language_id)->first();
        $cat = App\Models\CategoryLanguage::query()->where('category_id',$category->id)->where('language_id',$language_id)->first();
        ?>
        {{--@dd($cat,$prod)--}}

        @if($cat && $prod)
            <link rel="alternate" hreflang="{{$lang['locale']}}" href="{{route('productDetailsSeo',['locale' => $lang['abbreviation'],'category' => $cat->slug, 'product' => $prod->slug])}}" />
        @endif

    @endforeach



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
                            <div class="fullview_slider_item active" style="position: relative">
                                <img
                                    src="/storage/product/{{$file->fileable_id}}/thumb/{{$file->name}}"
                                    alt="{{count($file->availableLanguage)>0?$file->availableLanguage[0]->title:""}}"/>
                            </div>
                        @endforeach
                    </div>
                    <!-- <button class="arrow" id="arrow_slide_up">
                        <img src="/img/icons/slider/next.png" alt=""/>
                    </button>
                    <button class="arrow" id="arrow_slide_down">
                        <img src="/img/icons/slider/next.png" alt=""/>
                    </button> -->
                </div>


                <div class="large_view">
                    @foreach($product->files as $key=>$file)
                    <div class="magnified_img {{$key==0?"display":""}}" style="position: relative;">
                        @if ($product->sold)
                        <img src="/img/icons/sold.png" style="width:15%; position:absolute; z-index:99; right:15px; top:5px" alt="" />
                       @endif
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
                <span>{{__('client.category')}} :</span> {{(count($category->availableLanguage)> 0) ? $category->availableLanguage[0]->title : ''}}
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
            <div class="max-width" style="max-width: 360px ">

                <div class="btns flex">
                    <div class="number_input">
                        <button class="decrease" onclick="decreaseValue('details')">-</button>
                        <input disabled id="product_numb" type="text" class="number" value="1"/>
                        <button class="increase" onclick="increaseValue('details')">+</button>
                    </div>

                    <button
                        {{--{{count($productAnswers)>0?"disabled":""}}--}}
                        @if (!$product->sold)
                        onclick="addToCartProductDetails(this, '{{$product->id}}')"
                        @else
                        onclick=""
                        @endif

                        class="add_to_cart">
                        <img src="/img/icons/details/cart.png" alt=""/>
                        <div>{{__('client.add_to_cart')}}</div>
                    </button>
                </div>

                      <button
                        {{--{{count($productAnswers)>0?"disabled":""}}--}}
                        @if (!$product->sold)
                        onclick="addToCartProductDetails(this, '{{$product->id}}', true)"
                        @else
                        onclick=""
                        @endif

                        class=" buy_now">
                        <div>{{__('client.buynow')}}</div>
                     </button>
                     <button data-modal-target="#modal">{{__('client.size_guide')}}</button>


                     <div class="size-guide modal" id="modal">
                        <div class="modal-content">
                        <div class="sizemodal-header">
                            <div class="title">{{__('client.size_guide_title')}}</div>
                            <button data-close-button class="close-button">&times;</button>
                        </div>
                        <div class="brand-size flex">
                            <div class="sex">
                            <div class="sex-title">
                                {{__('client.size_choose_sex')}}
                            </div>
                            <div class="sexBtns">
                            <button class="sex-select active" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="17.534" height="17.534" viewBox="0 0 17.534 17.534">
                            <path id="Icon_ionic-md-male" data-name="Icon ionic-md-male" d="M18.885,3.375H13.491V5.4h3.966l-4.5,4.493a6.068,6.068,0,1,0,1.433,1.433l4.493-4.5v3.966h2.023V3.375ZM9.444,18.885a4.046,4.046,0,1,1,4.046-4.046A4.053,4.053,0,0,1,9.444,18.885Z" transform="translate(-3.375 -3.375)" />
                            </svg>

                            {{__('client.button_boy')}}</button>
                            <button  class="sex-select" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="11.272" height="17.534" viewBox="0 0 11.272 17.534">
                            <path id="Icon_ionic-md-female" data-name="Icon ionic-md-female" d="M19.147,7.886a5.636,5.636,0,1,0-6.575,5.558V15.4H9.754v1.879h2.818v2.5H14.45v-2.5h2.818V15.4H14.45V13.443A5.635,5.635,0,0,0,19.147,7.886Zm-9.393,0a3.757,3.757,0,1,1,3.757,3.757A3.763,3.763,0,0,1,9.754,7.886Z" transform="translate(-7.875 -2.25)" />
                            </svg>
                            @php
                                $page = App\Models\Page::where(['status' => true, 'type' => 'products'])->with('availableLanguage')->first()
                            @endphp
                           {{-- @dd($page->files[0]) --}}
                            {{__('client.button_girl')}}</button>
                            </div>

                            @if (isset($page->files[0]))
                            <img src={{asset('storage/page/'.$page->files[0]->fileable_id. "/". $page->files[0]->name)}} alt="">
                          @else
                            <img src="/img/icons/modal/body.png" alt="">
                          @endif

                        </div>
                        <div  class="gendertabs show">
                            <div class="table">
                        <table id="size-table">
                                <tr>
                                    <td>ბავშის ასაკი</td>
                                    <td>გულმკერდი</td>
                                    <td>წელი</td>
                                    <td>თეძო</td>
                                    <td>ზურგის სიმაღლე</td>
                                    <td>მკლავის სიგრძე</td>
                                    <td>შარვლის სიგრძე</td>
                                    <td>მხრის სიგანე</td>
                                </tr>
{{-- @php
    $gender = App\Models\SizeGuide::where('gender', 0)->get();
    $gender1 = App\Models\SizeGuide::where('gender', 1)->get();
@endphp
                                {{-- {{App\Models\SizeGuide::where('gender', 1)->get()}} --}}



                            </table>
                            </div>

                        </div>
                        <div  class="gendertabs">
                            <table id="size-table">
                                <tr>
                                    <td>ბავშის ასაკი</td>
                                    <td>გულმკერდი</td>
                                    <td>წელი</td>
                                    <td>თეძო</td>
                                    <td>ზურგის სიმაღლე</td>
                                    <td>მკლავის სიგრძე</td>
                                    <td>შარვლის სიგრძე</td>
                                    <td>მხრის სიგანე</td>
                                </tr>

                                {{-- {{App\Models\SizeGuide::where('gender', 1)->get()}} --}}



                            </table>
                        </div>
                        </div>
                     </div>
                     </div>

            </div>
            <div id="modal-overlay"></div>

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
