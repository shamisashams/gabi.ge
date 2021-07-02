@extends('layouts.base')

@section('content')
    <section class="final_details_bg flex center">
        <div class="final_details_content">
            <div class="content">
                <button class="close_final_detail">
                    <img src="/img/icons/popup/close.png" alt=""/>
                </button>
                <div class="head flex center column">
                    <div class="title d2">{{('client.final_details_for_order')}} #{{$order->id}}</div>
                    <button class="print_this_page flex center column">
                        <img src="/img/icons/profile/print.png" alt=""/>
                        <div class="dc">Print this page</div>
                    </button>
                    <div class="h_i">
                        {{__('client.order_placed')}}: <span
                            class="dc"> {{date('d-m-Y', strtotime($order->created_at))}}</span>
                    </div>
                    <div class="h_i">
                        {{__('client.order_number')}}:
                        <span class="dc">{{$order->id}}</span>
                    </div>
                    <div class="h_i">{{__('total_price')}}: <span class="dc"> {{$order->total_price/100}} $ </span>
                    </div>
                </div>
                <div class="one">
                    <div class="d2 bot25">{{__('client.shipping_address')}}:</div>
                    <div class="para">
                        {{$order->address}} <br/>
                    </div>
                    <div class="dc">{{$order->city}}, {{$order->country}}</div>
                </div>
                <div class="two box">
                    <div class="d2 bot25 flex">
                        <div><strong>{{__('client.products')}}</strong></div>
                        <div class="flex flex_end">
                            <div><strong>{{__('client.features')}}</strong></div>
                            <div class="last"><strong>{{__('client.quantity')}}</strong></div>
                            <div class="last"><strong>{{__('client.price')}}</strong></div>
                        </div>
                    </div>
                    @foreach($orderProducts as $orderProduct)
                        <div class="para flex">
                            <div class="first">
                                {{count($orderProduct->availableLanguage)>0?$orderProduct->availableLanguage[0]->title:""}}

                            </div>
                            @if($orderProduct->product->saleProduct &&$orderProduct->product->saleProduct->sale)

                                <div class="flex flex_end">
                                    <div class="price">
                                        <p>
                                        @foreach($orderProduct->answers as $key=>$answer)
                                            {{count($answer->availableLanguage)>0?$answer->availableLanguage[0]->title:""}}{{$key<count($orderProduct->answers)-1?',':""}}
                                        @endforeach
                                        </p>
                                    </div>
                                    <div class="price last">{{$orderProduct->quantity}}</div>
                                    <div class="price last">
                                        {{\App\Models\Product::calculatePrice($orderProduct->product->price,$orderProduct->product->saleProduct->sale->discount,$orderProduct->product->saleProduct->sale->type)}}
                                        $
                                    </div>
                                </div>
                            @else
                                <div class="flex flex_end">
                                    <div class="price">{{$orderProduct->quantity}}</div>
                                    <div class="price last">
                                        {{$orderProduct->product->price/100}} $
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="three">
                    <div class="d2 bot25">{{__('client.payment_information')}}:</div>
                    <div class="flex bot25">
                        <div>
                            <div class="d2" style="margin-bottom: 5px">{{__('client.payment_method')}}:</div>
                            <div class="dc">Visa / last digits: 5135</div>
                        </div>
                        <div style="text-align: end">
                            <div class="d2">{{__('client.items_subtotal')}}
                                : {{($order->total_price/100)-$order->shipment_price}} $
                            </div>
                            <div class="d2">{{__('client.shipping_handling')}}: {{$order->shipment_price}} $</div>
                            <div class="d2">Free shipping: - 7.31 $</div>
                        </div>
                    </div>
                    {{--                    <div class="d2" style="margin-bottom: 16px">Billing address:</div>--}}
                    <div class="flex start">
                        <div class="dc">

                        </div>
                        <div class="right flex column">
                            <div class="d2" style="white-space: nowrap; margin-left: 5px">
                                <strong>{{__('grand_total')}}: {{$order->total_price/100}} $</strong>
                            </div>
                            <button class="print_this_page flex column">
                                <img src="/img/icons/profile/print.png" alt=""/>
                                <div class="dc">{{__('client.print_this_page')}}</div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{route('downloadPdf',[app()->getLocale(),$order->id])}}" download="">
                <button class="dl_pdf">{{__('client.download_pdf')}}</button>
            </a>
        </div>
    </section>

@endsection
