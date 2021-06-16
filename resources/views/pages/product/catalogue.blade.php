@extends('layouts.base')
@section('head')
    <title>{{__('app.title_home')}}</title>
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
            left:7px;
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
    <section class="product_content_section wrapper flex">
        <div class="sidebar_filters">
            <form>
                <div class="section">
                    <div class="titles">Price Filter</div>
                    <p>
                        Price: <label for="min">$130</label> — <label for="max">$550</label>
                    </p>
                    <div class="price_control">
                        <input id="min" type="text" value="$130 "/>
                        <input id="max" type="text" value="$550 "/>
                        <button class="ok">Ok</button>
                    </div>
                </div>
                @foreach($productFeatures as $productFeature)
                    <div class="section">
                        <div
                            class="titles">{{count($productFeature->feature->availableLanguage)>0?$productFeature->feature->availableLanguage[0]->title:""}}</div>
                        @foreach($productFeature->productAnswers as $productAnswer)
                            <div>
                                <label class="container">
                                    {{count($productAnswer->answer->availableLanguage)>0?$productAnswer->answer->availableLanguage[0]->title:""}}
                                    <input type="checkbox" name="feature[{{$productAnswer->feature->id}}][]"
                                           onchange="this.form.submit()"
                                           value="{{$productAnswer->answer->id}}">
                                    <span class="checkmark"></span>
                                </label>
{{--                            <input type="checkbox" style="display: inline-block" class="option chosen" id="" name="{{$productAnswer->answer->availableLanguage[0]->title}}"/>--}}
{{--                            <label class="option" for="checkbox1" style="display: inline-block ">--}}
{{--                                {{count($productAnswer->answer->availableLanguage)>0?$productAnswer->answer->availableLanguage[0]->title:""}}--}}
{{--                            </label>--}}
{{--                            </div>--}}
                            </div>
                        @endforeach
                    </div>
                @endforeach
{{--                <div class="section">--}}
{{--                    <div class="titles">Age</div>--}}
{{--                    <input type="radio" class="option"/>0 - 3 months--}}
{{--                    <button class="option chosen">3 - 6 months</button>--}}
{{--                    <button class="option">6 - 9 months</button>--}}
{{--                    <button class="option">9 - 12 months</button>--}}
{{--                    <div class="extras extra_age">--}}
{{--                        <button class="option">1 - 2 years</button>--}}
{{--                        <button class="option chosen">3 - 4 years</button>--}}
{{--                        <button class="option">5 - 6 years</button>--}}
{{--                        <button class="option">7 - 9 years</button>--}}
{{--                    </div>--}}
{{--                    <button class="show_more" id="show_more_age">Show more</button>--}}
{{--                </div>--}}
{{--                <div class="section">--}}
{{--                    <div class="titles">Size</div>--}}
{{--                    <button class="option">52 CM</button>--}}
{{--                    <button class="option">52 CM</button>--}}
{{--                    <button class="option">52 CM</button>--}}
{{--                    <div class="extras extra_size">--}}
{{--                        <button class="option">52 CM</button>--}}
{{--                        <button class="option">52 CM</button>--}}
{{--                        <button class="option">52 CM</button>--}}
{{--                    </div>--}}
{{--                    <button class="show_more" id="show_more_size">Show more</button>--}}
{{--                </div>--}}
{{--                <div class="section">--}}
{{--                    <div class="titles">Color</div>--}}
{{--                    <button class="color" style="background-color: #5e5e5e"></button>--}}
{{--                    <button class="color" style="background-color: #ffe0a2"></button>--}}
{{--                    <button class="color" style="background-color: #095e00"></button>--}}
{{--                    <button class="color" style="background-color: #60a8fb"></button>--}}
{{--                    <button class="color" style="background-color: #fb9e60"></button>--}}
{{--                    <button class="color" style="background-color: #ec3490"></button>--}}
{{--                    <button class="color" style="background-color: #6a3b00"></button>--}}
{{--                    <button class="color" style="background-color: #959595"></button>--}}
{{--                    <button class="color" style="background-color: #ffe6c7"></button>--}}
{{--                    <button class="color" style="background-color: #00a441"></button>--}}
{{--                    <button class="color" style="background-color: #ffeed9"></button>--}}
{{--                    <button class="color" style="background-color: #182caf"></button>--}}
{{--                </div>--}}
            </form>
        </div>
        <section class="products_viewport">
            <div class="products_head flex">
                <div class="title">Category Name</div>
                <a href="#" class="see_more">See More</a>
            </div>
            <div class="product_grid">
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/1.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/2.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                            <div class="discount">$100.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/3.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/4.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/1.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/2.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                            <div class="discount">$100.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/3.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/4.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/1.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/2.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                            <div class="discount">$100.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/3.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/4.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/1.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/2.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                            <div class="discount">$100.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/3.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
                <div class="main_product_view">
                    <div class="pic">
                        <div class="label off">-20%</div>
                        <img class="p_img" src="img/products/4.png" alt=""/>
                        <button class="add_to_cart">
                            <img src="img/icons/header/cart.png" alt=""/>
                            <div class="roboto">Add to Cart</div>
                        </button>
                    </div>
                    <div class="detail flex">
                        <div>
                            <div class="title">Floral Print Dress Blue</div>
                            <div class="sub roboto">JACADI</div>
                        </div>
                        <div>
                            <div class="title price">$80.00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination">
                <button class="prev_page">Previous</button>
                <div class="pagination_slides">
                    <button class="page_number">1</button>
                    <button class="page_number active">2</button>
                    <button class="page_number">3</button>
                    <button class="page_number">4</button>
                    <button class="page_number">5</button>
                    <button class="page_number">6</button>
                    <button class="page_number">7</button>
                    <button class="page_number">8</button>
                    <button class="page_number">9</button>
                </div>
                <button class="next_page">Next</button>
            </div>
            <div class="page_input">
                <input type="text" placeholder="Enter Page"/>
                <button class="ok">Ok</button>
            </div>
        </section>
    </section>

@endsection
