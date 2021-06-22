@extends('layouts.base')
@section('head')
    <title>{{__('app.title_home')}}</title>
@endsection

@section('content')
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took">Home / shop / shopping cart</div>
            <div class="current">shopping cart</div>
        </div>
    </section>

    <section class="shopping_cart_body wrapper flex">
        <div class="shopping_table">
            <div>
                <div class="heads row flex">
                    <div class="c1">{{__('client.products')}}</div>
                    <div class="c2">{{__('client.price')}}</div>
                    <div class="c2">{{__('client.features')}}</div>
                    <div class="c2">{{__('client.quantity')}}</div>
                    <div class="c2">{{__('client.total')}}</div>
                </div>
                @foreach($products as $product)
                    <div class="item row flex cart_item_shoppingcart" id="product_item-{{$product['id']}}-{{$product['features']}}">
                        <div class="c1 flex">
                            <div class="img">
                                @if($product['file'])
                                    <img
                                        src="/storage/product/{{$product['id']}}/{{$product['file']}}"
                                        alt=""/>
                                @else
                                    <img src="/noimage.png"/>
                                @endif
                            </div>
                            <div>{{$product['title']}}</div>
                        </div>
                        <div class="c2" id="car_product_price-{{$product['id']}}">$ {{$product['sale']?:$product['price']}}</div>
                        <div class="c2">
                            @foreach($product['options'] as $key=>$option)
                                {{count($option->availableLanguage)>0?$option->availableLanguage[0]->title:""}}{{$key<count($product['options'])-1?',':""}}
                            @endforeach
                        </div>
                        <div class="c2 quantity">
                            <div class="number_input">
                                <button onclick="decrease('{{$product['id']}}',{{$product['features']}})" class="decrease">-</button>
                                <input
                                    class="product_number"
                                    type="text"
                                    disabled
                                    id="product_number-{{$product['id']}}-{{$product['features']}}"
                                    value="{{$product['quantity']}}"
                                />
                                <button class="increase" onclick="increase('{{$product['id']}}',{{$product['features']}})">+</button>
                            </div>
                        </div>
                        <div class="c2" id="cart_product_total-{{$product['id']}}-{{$product['features']}}">${{($product['sale']?:$product['price'])*$product['quantity']}}</div>
                        <p hidden>{{$product['features']}}</p>
                        <button class="remove_item_cart" onclick="removefromcart(null,{{$product['id']}},{{$product['features']}})">
                            <img src="/img/icons/header/remove.png" alt=""/>
                        </button>
                    </div>
                @endforeach
                <div class="flex coupon">
                    <input type="text" placeholder="Coupon Code"/>
                    <button class="ok">Ok</button>
                </div>
            </div>
        </div>
        <div class="cart_total_fee">
            <div class="head row">Cart Total</div>
            <div class="row flex">
                <div>{{__('client.sub_total')}}:</div>
                <div id="sub-total">${{round($total,2)}}</div>
            </div>
            <div class="row">
                <div>{{__('client.shipping')}}:</div>
                <br/>
                <div class="flex inputs">
                    <div>
                        <input type="radio" name="shipping" id="ship_1"/><label
                            for="ship_1"
                        >Free Shipping</label
                        >
                    </div>
                    <div>$00.00</div>
                </div>
                <div class="flex inputs">
                    <div>
                        <input type="radio" name="shipping" id="ship_2"/><label
                            for="ship_2"
                        >Standard Shipping</label
                        >
                    </div>
                    <div>$10.00</div>
                </div>
                <div class="flex inputs">
                    <div>
                        <input type="radio" name="shipping" id="ship_3"/><label
                            for="ship_3"
                        >Express Shipping</label
                        >
                    </div>
                    <div>$20.00</div>
                </div>
            </div>
            <div class="row">
                <div>Address:</div>
                <br/>
                <div class="inputs">
                    <input type="radio" name="address" id="adrs_1"/><label for="adrs_1"
                    >Georgia, Tbilisi - Vazha-Pshavela IV Turn</label
                    >
                </div>
                <div class="inputs">
                    <input type="radio" name="address" id="adrs_2"/><label for="adrs_2"
                    >Georgia, Tbilisi - Didi Dighomi III Micro-District</label
                    >
                </div>
                <br/>
                <a href="#" class="address">Change address</a>
            </div>
            <div class="flex total">
                <div>Total</div>
                <div>$313.00</div>
            </div>
            <a href="#">
                <button class="proceed">Proceed To Checkout</button>
            </a>
        </div>
    </section>

@endsection
