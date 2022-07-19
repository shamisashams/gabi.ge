@extends('layouts.base')
@section('head')
    <title>{{__('app.cart')}}</title>
    <meta name="description" content="{{__('app.cart')}}">
    <meta name="keywords" content="{{__('app.cart')}}">
@endsection

@section('content')
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome')}}">@lang('client.home')</a></div>
            <div class="current">{{__('client.shopping_cart')}}</div>
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
                    <div class="item row flex cart_item_shoppingcart"
                         id="product_item-{{$product['id']}}-{{$product['features']}}">
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
                        <div class="c2" id="car_product_price-{{$product['id']}}">
                            ₾ {{$product['sale']?:$product['price']}}</div>
                        <div class="c2">
                            @foreach($product['options'] as $key=>$option)
                                {{count($option->availableLanguage)>0?$option->availableLanguage[0]->title:""}}{{$key<count($product['options'])-1?',':""}}
                            @endforeach
                        </div>
                        <div class="c2 quantity">
                            <div class="number_input">
                                <button onclick="decrease('{{$product['id']}}',{{$product['features']}})"
                                        class="decrease">-
                                </button>
                                <input
                                    class="product_number"
                                    type="text"
                                    disabled
                                    id="product_number-{{$product['id']}}-{{$product['features']}}"
                                    value="{{$product['quantity']}}"
                                />
                                <button class="increase"
                                        onclick="increase('{{$product['id']}}',{{$product['features']}})">+
                                </button>
                            </div>
                        </div>
                        <div class="c2" id="cart_product_total-{{$product['id']}}-{{$product['features']}}">
                            ₾{{($product['sale']?:$product['price'])*$product['quantity']}}</div>
                        <p hidden>{{$product['features']}}</p>
                        <button class="remove_item_cart"
                                onclick="removefromcart(null,{{$product['id']}},{{$product['features']}})">
                            <img src="/img/icons/header/remove.png" alt=""/>
                        </button>
                    </div>
                @endforeach
                {{--<div class="flex coupon">
                    <input type="text" placeholder="{{__('client.coupon_code')}}"/>
                    <button class="ok">{{__('client.ok')}}</button>
                </div>--}}
            </div>
        </div>
        <div class="cart_total_fee">
            <div class="head row">{{__('client.cart_total')}}</div>
            <div class="row flex">
                <div>{{__('client.sub_total')}}:</div>
                <div id="sub-total">₾{{round($total,2)}}</div>
            </div>
            <form method="post" action="{{route('saveOrder',app()->getLocale())}}">
                @csrf
                <div class="row">
                    <div>{{__('client.shipping')}}:</div>
                    <br/>
                    {{--@foreach($shipping as $item)--}}
                    <div class="flex inputs">
                        <div>
                            <input onchange="changeTotalPrice(this)" type="radio" name="shipping" id="ship_from_office"
                                   value="from_office" data-price=""/>
                            <label for="ship_from_office">@lang('client.from_office')</label>
                        </div>
                        <div>₾0.00</div>
                    </div>

                    <div class="flex inputs">
                        <div>
                            <input onchange="changeTotalPrice(this)" type="radio" name="shipping" id="ship_to_address"
                                   value="to_address" data-price=""/>
                            <label for="ship_to_address">@lang('client.to_address')</label>
                        </div>
                        <div id="to_address_price">₾0.00</div>
                    </div>
                    {{--@endforeach--}}
                    @if ($errors->has('shipping'))
                        <p class="profile-error-block">{{ $errors->first('shipping') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div>{{__('client.address')}}:</div>
                    <br/>
                    @if(auth()->user())

                        @foreach(auth()->user()->addresses()->has('city_r')->get() as $address)
                            <div class="flex inputs">
                                <div>
                                    <input onchange="changeTotalPrice2(this)" data-ship="{{$address->city_r->ship_price / 100}}" id="address_{{$address->id}}" type="radio" name="address" value="{{$address->id}}"/>
                                    <label for="address_{{$address->id}}" class="inputs">
                                        {{$address->country_r->language ? $address->country_r->language->title:''}}, {{$address->city_r->language ? $address->city_r->language->title:''}}<br>
                                        {{$address->address_1}}

                                    </label>
                                </div>
                            </div>


                        @endforeach
                            @if ($errors->has('address'))
                                <p class="profile-error-block">{{ __('client.please_set_address') }}</p>
                            @endif
                        <a href="{{route('profile',app()->getLocale())}}" class="address">
                            {{auth()->user()->profile->address?__('client.change_address'):__('client.set_address')}}
                        </a>
                    @endif
                </div>
                <div class="row last">
                    <div>{{__('client.payment_method')}}:</div>
                    <br/>
                    <div class="flex">
                        {{-- <div>
                            <input onchange="hideBank()" type="radio" name="payment_method" value="cash"
                                   id="pmmt_cash"/>
                            <label for="pmmt_cash">{{__('client.cash')}}</label>

                        </div> --}}
                        <div>
                            <input onchange="showBank()" type="radio" name="payment_method" value="card"
                                   id="pmmt_bank"/>
                            <label for="pmmt_bank">{{__('client.card')}}</label>
                        </div>
                    </div>

                    <div class="banks flex banks_pmmt">
                        @foreach($banks as $bank)
                            <?php
                            $name = "";
                            switch ($bank->title) {
                                case 'tbc':
                                    $name = "tbc.png";
                                    $title = __('client.bank_tbc');
                                    break;
                                case 'bog':
                                    $name = "georgian-bank.png";
                                    $title = __('client.bank_bog');
                                    break;
                                case 'redo':
                                    $name = 'credo.png';
                                    break;
                            }
                            ?>
                            <input id="{{$bank->title}}" name="bank" value="{{$bank->id}}" type="radio"/>
                            <label for="{{$bank->title}}"> <img style="width: 150px" src="/img/banks/{{$name}}" alt=""/></label>
                        @endforeach
                    </div>
                    <br>
                    @if ($errors->has('payment_method'))
                        <p class="profile-error-block">{{__('client.please_choose_payment_method')}}</p>
                    @elseif($errors->has('bank'))
                        <p class="profile-error-block">{{__('client.pleas_choose_bank')}}</p>
                    @endif
                </div>
                <div class="flex total">
                    <div>{{__('client.total')}}</div>
                    <div id="total-price" data-price="">₾ {{round($total,2)}}</div>
                </div>
                <button type="submit" class="proceed">{{__('client.proceed_checkout')}}</button>

            </form>
        </div>
    </section>

@endsection
