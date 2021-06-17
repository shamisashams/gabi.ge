@extends('layouts.base')
@section('head')
    <title>{{__('app.title_home')}}</title>
@endsection

@section('content')
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took">
                Home / Summer collections / Boys / Baby Dress
            </div>
            <div class="current">BABY DRESS</div>
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
                                    src="/storage/product/{{$file->fileable_id}}/{{$file->name}}"
                                    alt=""/>
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
                        <img
                            class="large_image_view {{$key==0?"display":""}}"
                            src="/storage/product/{{$file->fileable_id}}/{{$file->name}}"
                            alt=""
                        />
                    @endforeach
                </div>
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
        <div class="customize">
            <div
                class="product_name roboto">{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</div>
            <p><span>ID:</span> {{$product->id}}</p>
            <p>
                <span>Category:</span> {{(count($category->availableLanguage)> 0) ? $category->availableLanguage[0]->title : ''}}
            </p>
            <div class="prices flex">
                @if($product->saleProduct && $product->saleProduct->sale)
                    <div class="main">
                        $ {{\App\Models\Product::calculatePrice($product->price,$product->saleProduct->sale->discount,$product->saleProduct->sale->type)}}</div>
                    <div class="last">$ {{round($product->price/100,2)}}</div>
                    <div class="off">
                        @if($product->saleProduct->sale->type=="percent")
                            -{{$product->saleProduct->sale->discount}}%
                        @else
                            -{{round(($product->saleProduct->sale->discount*100)/($product->price/100))}} %
                        @endif
                    </div>
                @else
                    <div class="main">$ {{round($product->price/100,2)}}</div>
                @endif
            </div>
            <div class="colors">
                <div class="title">Color</div>
                <button
                    class="color picked"
                    style="background-color: #faeadb"
                ></button>
                <button class="color" style="background-color: #fbfebd"></button>
                <button class="color" style="background-color: #dbfafa"></button>
                <button class="color" style="background-color: #fadbe7"></button>
            </div>

            @foreach($product->answers as $key => $answer)
                <li>
                    @if(count($answer->feature->availableLanguage) > 0)
                        @if($key > 0)
                            @if(count($product->answers[$key-1]->feature->availableLanguage) > 0)
                                @if($product->answers[$key-1]->feature->availableLanguage[0]->title === $answer->feature->availableLanguage[0]->title)
                                    <span></span>
                                @else
                                    <span>{{$answer->feature->availableLanguage[0]->title}}:</span>
                                @endif
                            @else
                                <span>{{$answer->feature->availableLanguage[0]->title}}:</span>
                            @endif
                        @else
                            <span>{{$answer->feature->availableLanguage[0]->title}}:</span>
                        @endif
                    @endif
                    @if(count($answer->answer->availableLanguage) > 0)
                        <span>{{$answer->answer->availableLanguage[0]->title}}</span>
                    @endif
                </li>
            @endforeach

            @foreach($product->answers as $key => $answer)
                <div class="options">
                    @if(count($answer->feature->availableLanguage) > 0)
                        @if($key > 0)
                            @if(count($product->answers[$key-1]->feature->availableLanguage) > 0)
                                @if($product->answers[$key-1]->feature->availableLanguage[0]->title === $answer->feature->availableLanguage[0]->title)
                                    <span></span>
                                @else

                                    <div class="title">{{$answer->feature->availableLanguage[0]->title}}</div>
                                @endif
                            @else
                                <div class="title">{{$answer->feature->availableLanguage[0]->title}}</div>
                            @endif
                        @else
                            <div class="title">{{$answer->feature->availableLanguage[0]->title}}</div>
                        @endif
                    @endif
                    @if(count($answer->answer->availableLanguage) > 0)
                        <span>{{$answer->answer->availableLanguage[0]->title}}</span>
                    @endif


                    <div class="box_grid">
                        <div class="box">
                            <input type="radio" name="size" id="size1"/>
                            <label for="size1" class="box">52 CM</label>
                        </div>
                        <div class="box">
                            <input type="radio" name="size" id="size2"/>
                            <label for="size2" class="box">52 CM</label>
                        </div>
                        <div class="box">
                            <input type="radio" name="size" id="size3"/>
                            <label for="size3" class="box">52 CM</label>
                        </div>
                        <div class="box">
                            <input type="radio" name="size" id="size4"/>
                            <label for="size4" class="box">52 CM</label>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="options">
                <div class="title">Age</div>
                <div class="box_grid">
                    <div class="box">
                        <input type="radio" name="age" id="age1"/>
                        <label for="age1" class="box">3 - 6 Months</label>
                    </div>
                    <div class="box">
                        <input type="radio" name="age" id="age2"/>
                        <label for="age2" class="box">3 - 6 Months</label>
                    </div>
                    <div class="box">
                        <input type="radio" name="age" id="age3"/>
                        <label for="age3" class="box">3 - 6 Months</label>
                    </div>
                    <div class="box">
                        <input type="radio" name="age" id="age4"/>
                        <label for="age4" class="box">3 - 6 Months</label>
                    </div>
                </div>
            </div>
            <div class="btns flex">
                <div class="number_input">
                    <button class="decrease" onclick="decreaseValue()">-</button>
                    <input id="product_number" type="text" class="number" value="1"/>
                    <button class="increase" onclick="increaseValue()">+</button>
                </div>
                <a href="#">
                    <button class="add_to_cart">
                        <img src="img/icons/header/cart.png" alt=""/>
                        <div>Add To Card</div>
                    </button>
                </a>
            </div>
        </div>
    </section>
    <section class="information_section">
        <div class="heads">
            <div class="info_head clicked">Description</div>
            <div class="info_head">Additional Information</div>
            <div class="info_head">Shipping & Returns</div>
        </div>
        <div class="information_content wrapper clicked">
            {{--            <div class="title">Product Information</div>--}}
            <p class="para">
                {{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->short_description : ''}}
            </p>
            {{--            <ul>--}}
            {{--                <li class="para">--}}
            {{--                    • Nunc Nec Porttitor Turpis. In Eu Risus Enim. In Vitae Mollis Elit.--}}
            {{--                </li>--}}
            {{--                <li class="para">--}}
            {{--                    • Nunc Nec Porttitor Turpis. In Eu Risus Enim. In Vitae Mollis Elit.--}}
            {{--                </li>--}}
            {{--                <li class="para">--}}
            {{--                    • Nunc Nec Porttitor Turpis. In Eu Risus Enim. In Vitae Mollis Elit.--}}
            {{--                </li>--}}
            {{--            </ul>--}}
            {{--            <div class="para">--}}
            {{--                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio.--}}
            {{--                Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.--}}
            {{--                Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec--}}
            {{--                nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit--}}
            {{--                amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices--}}
            {{--                nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate--}}
            {{--                sem tristique cursus.--}}
            {{--            </div>--}}
        </div>
        <div class="information_content wrapper">
            {{--            <div class="title">Additional Information</div>--}}
            {{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->description : ''}}
        </div>
        <div class="information_content wrapper">
            <div class="title">Shipping & Returns</div>
        </div>
    </section>
    @include('pages.best-sellers.index')
@endsection
