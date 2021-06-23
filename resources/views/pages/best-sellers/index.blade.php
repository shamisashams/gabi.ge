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

                        <button class="add_to_cart">
                            <img src="/img/icons/header/cart.png" alt=""/>
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

