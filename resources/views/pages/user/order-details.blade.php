@extends('layouts.base')

@section('content')
    <section class="final_details_bg flex center">
        <div class="final_details_content">
            <div class="content">
                <button class="close_final_detail">
                    <img src="/img/icons/popup/close.png" alt=""/>
                </button>
                <div class="head flex center column">
                    <div class="title d2">Final details for order #1102-0030022</div>
                    <button class="print_this_page flex center column">
                        <img src="/img/icons/profile/print.png" alt=""/>
                        <div class="dc">Print this page</div>
                    </button>
                    <div class="h_i">
                        Order placed: <span class="dc"> march 21, 2021 </span>
                    </div>
                    <div class="h_i">
                        Order number:
                        <span class="dc"> march 21, 202111001-011074-011 </span>
                    </div>
                    <div class="h_i">Total order: <span class="dc"> 61.68$ </span></div>
                </div>
                <div class="one">
                    <div class="d2 bot25">Shipping address:</div>
                    <div class="para">
                        Lorem ipsum dolor sit amet, consectetur <br/>
                        adipiscing elit, sed do eiusmod tempor
                    </div>
                    <div class="dc">Tbilisi, Georgia</div>
                </div>
                <div class="two box">
                    <div class="d2 bot25 flex">
                        <div>Items orderd:</div>
                        <div><strong>Price</strong></div>
                    </div>
                    <div class="para flex">
                        <div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna
                        </div>
                        <div class="price">61.68 $</div>
                    </div>
                    <div class="para flex">
                        <div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna
                        </div>
                        <div class="price">61.68 $</div>
                    </div>
                </div>
                <div class="three">
                    <div class="d2 bot25">payment information:</div>
                    <div class="flex bot25">
                        <div>
                            <div class="d2" style="margin-bottom: 5px">payment method:</div>
                            <div class="dc">Visa / last digits: 5135</div>
                        </div>
                        <div style="text-align: end">
                            <div class="d2">Items subtotal: 61.68 $</div>
                            <div class="d2">Shipping & handling: 7.31 $</div>
                            <div class="d2">Free shipping: - 7.31 $</div>
                        </div>
                    </div>
                    <div class="d2" style="margin-bottom: 16px">Billing address:</div>
                    <div class="flex start">
                        <div class="dc">
                            Lorem ipsum dolor sit amet, consectetur <br/>
                            adipiscing elit, sed do eiusmod tempor
                        </div>
                        <div class="right flex column">
                            <div class="d2" style="white-space: nowrap; margin-left: 5px">
                                <strong>Grand total: 61.68 $</strong>
                            </div>
                            <button class="print_this_page flex column">
                                <img src="img/icons/profile/print.png" alt=""/>
                                <div class="dc">Print this page</div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <button class="dl_pdf">Download Pdf</button>
            </a>
        </div>
    </section>

@endsection
