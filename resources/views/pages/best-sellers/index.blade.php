<section class="products_viewport wrapper">
    <div class="products_head flex">
        <div class="title">{{__('client.best-sellers')}}</div>
        <a href="#" class="see_more">{{__('client.see_more')}}</a>
    </div>
    <div class="arrows">
        <button id="next_bs">
            <img src="/img/icons/slider/next.png" alt=""/>
        </button>
    </div>
    <div class="flex best_seller_slide">

        @foreach($bestSellerProducts as $product)
            <div class="main_product_view">
                <a href="{{route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug:null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug:null])}}">
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
                        <div class="on_hover_btns">
                            <a class="view_popup_product">
                                <button onclick="addToModal({{$product}})" class="add_to_cart view">
                                    <img src="/img/icons/profile/view.svg" alt="" />
                                    <div class="roboto">{{__('client.view')}}</div>
                                </button>
                            </a>
                            <a href="{{route('productDetailsSeo',[app()->getLocale(),isset($product->category->availableLanguageS->slug) ? $product->category->availableLanguageS->slug:null,isset($product->availableLanguageS->slug) ? $product->availableLanguageS->slug:null])}}">
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

