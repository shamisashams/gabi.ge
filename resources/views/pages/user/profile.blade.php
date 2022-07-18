@extends('layouts.base')
@section('head')
        <title>{{__('app.profile')}}</title>
@endsection
@section('content')
    <section class="path">
        <div class="path_content wrapper">
            <div class="path_took"><a href="{{route('welcome',app()->getLocale())}}">{{__('client.home')}} </a>
                </div>
            <div class="current">{{__('client.profile')}}</div>
        </div>
    </section>

    <section class="profile_section wrapper flex">
        <div class="profile_tabs">
            <div class="row flex head">
                <div class="title roboto">
                    {{__('client.welcome_to')}} <br/>
                    <span class="bold roboto">{{$user->name}}</span>
                </div>
                <?php

                if($user->google_avatar){
                    $avatar = asset('storage/' . str_replace('public/','',$user->google_avatar));
                } elseif ($user->facebook_avatar){
                    $avatar = asset('storage/' . $user->facebook_avatar);
                } else {
                    $avatar = asset('/img/icons/profile/avatar.png');
                }
                ?>
                <div class="icn">
                    <img id="userAvatarImg" src="{{$avatar}}" alt=""/>
                    <input id="userAvatarInput" type="file" name="avatar" id="">
                    <div class="add_img flex center">
                        <img src="/img/icons/profile/upload.png" alt=""/>
                    </div>
                </div>
            </div>
            <div class="row middle">
                <div id="tab-profile" class="link profile_tab_name clicked"
                     onclick="changeType('profile')">{{__('client.my_profiles')}}</div>
                <div id="tab-order" class="link profile_tab_name"
                     onclick="changeType('order')">{{__('client.order_history')}}</div>
                <div id="tab-password" class="link profile_tab_name"
                     onclick="changeType('password')">{{__('client.change_password')}}</div>
            </div>
            <div class="row last">
                <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['helps']['slug']) ? $page_slugs['helps']['slug'] : null])}}" class="link">{{__('client.helps')}}</a>
                <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['contact-us']['slug']) ? $page_slugs['contact-us']['slug'] : null])}}" class="link">{{__('client.contact_us')}}</a>
            </div>
            <button onclick="window.location.href='{{route('logoutFront',app()->getLocale())}}'"
                    class="log_out">{{__('client.log_out')}}</button>
        </div>
        <div class="profile_tabs_content clicked">
            @include('layouts.alert.alert')
            <div class="title">{{__('client.change_your_profile')}}</div>
            <form method="post" action="{{route('profileUpdate',app()->getLocale())}}" enctype="multipart/form-data">
                @csrf
                <div class="input_grid">
                    <div class="input">
                        <label for="">{{__('client.first_name')}}</label>
                        <input value="{{$user->profile->first_name}}"
                               class="{{$errors->has('first_name')?'invalid':""}}" name="first_name" type="text "
                               placeholder="Enter your name"/>
                        @if ($errors->has('first_name'))
                            <p class="profile-error-block">{{ $errors->first('first_name') }}</p>
                        @endif

                    </div>
                    <div class="input">
                        <label for="">{{__('client.last_name')}}</label>
                        <input value="{{$user->profile->last_name}}" class="{{$errors->has('last_name')?'invalid':""}}"
                               name="last_name" type="text " placeholder="Enter your last name"/>
                        @if ($errors->has('last_name'))
                            <p class="profile-error-block">{{ $errors->first('last_name') }}</p>
                        @endif
                    </div>
                    <div class="input">
                        <label for="">{{__('client.email_address')}}</label>
                        <input disabled value="{{$user->email}}" name="email" type="text"
                               placeholder="example@email.com"/>
                    </div>
                    <div class="input">
                        <label for="">{{__('client.phone')}}</label>
                        <input value="{{$user->profile->phone}}" class="{{$errors->has('phone')?'invalid':""}}"
                               name="phone" type="tel" placeholder="+995 595 555 999 999"/>
                        @if ($errors->has('phone'))
                            <p class="profile-error-block">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                </div>

               {{-- @dd($countries,$cities)--}}
                <div id="addressFields">
                    @if(count($user->addresses) > 0)
                        @foreach($user->addresses as $address)
                        <div class="addressFieldsChild">
                            <div class="title flex"><span>{{__('client.useraddress')}}</span> <button type="button" class="removeField">{{__('client.remove_address')}}</button></div>
                            <div class="input_grid">
                                    <div class="input">
                                    <label for="">{{__('client.choose_country')}}</label>
                                    {{--<input value="{{$address->country}}" class="{{$errors->has('country')?'invalid':""}}"
                                           name="country[]" type="text" placeholder="Georgia"/>--}}
                                        <select class="country_sel" name="country_id[]">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{$address->country_id == $country->id ? 'selected':''}}>{{$country->language ? $country->language->title:''}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('country_id.*'))
                                        <p class="profile-error-block">{{ $errors->first('country') }}</p>
                                    @endif
                                </div>
                                <div class="input">
                                    <label for="">{{__('client.choose_city')}}</label>
                                    {{--<input value="{{$address->city}}" class="{{$errors->has('city')?'invalid':""}}"
                                           name="city[]" type="text" placeholder="Tbilisi"/>--}}
                                    <select name="city_id[]">
                                        <option value=""></option>
                                        @if(isset($cities[$address->country_id]))
                                            @foreach($cities[$address->country_id] as $city)
                                                <option value="{{$city->id}}" {{$address->city_id == $city->id ? 'selected':''}}>{{$city->language ? $city->language->title:''}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('city_id.*'))
                                        <p class="profile-error-block">{{ $errors->first('city.*') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="input address">
                                <label for="">{{__('client.choose_address')}}</label>
                                <input
                                    type="text"
                                    name="address[]"
                                    class="{{$errors->has('address')?'invalid':""}}"
                                    value="{{$address->address_1}}"
                                    placeholder="Georgia, Tbilisi - Didi Dighomi III Micro-District"
                                />
                                @if ($errors->has('address'))
                                    <p class="profile-error-block">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="addressFieldsChild">
                            <div class="title flex"><span>Address</span> <button type="button" class="removeField">Remove</button></div>
                            <div class="input_grid">
                                <div class="input">
                                    <label for="">{{__('client.choose_country')}}</label>
                                   {{-- <input class="{{$errors->has('country')?'invalid':""}}"
                                           name="country[]" type="text" placeholder="Georgia"/>--}}
                                    <select class="country_sel" name="country_id[]">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{$address->country_id == $country->id ? 'selected':''}}>{{$country->language ? $country->language->title:''}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country_id.*'))
                                        <p class="profile-error-block">{{ $errors->first('country_id.*') }}</p>
                                    @endif
                                </div>
                                <div class="input">
                                    <label for="">{{__('client.choose_city')}}</label>
                                    {{--<input class="{{$errors->has('city')?'invalid':""}}"
                                           name="city[]" type="text" placeholder="Tbilisi"/>--}}
                                    <select name="city_id[]">
                                        <option value=""></option>
                                        @if(isset($cities[$address->country_id]))
                                            @foreach($cities[$address->country_id] as $city)
                                                <option value="{{$city->id}}" {{$address->city_id == $city->id ? 'selected':''}}>{{$city->language ? $city->language->title:''}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('city_id.*'))
                                        <p class="profile-error-block">{{ $errors->first('city.*') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="input address">
                                <label for="">{{__('client.choose_address')}}</label>
                                <input
                                    type="text"
                                    name="address[]"
                                    class="{{$errors->has('address')?'invalid':""}}"
                                    placeholder="Georgia, Tbilisi - Didi Dighomi III Micro-District"
                                />
                                @if ($errors->has('address'))
                                    <p class="profile-error-block">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" id="addAddressField">{{__('client.additional_address')}}</button>

                <button class="update">{{__('client.update')}}</button>
            </form>



            {{--<div class="your_address">
                <div class="title">{{__('client.your_address')}}</div>
                <div class="address_table">
                    <div class="head flex">
                        <div>{{__('client.name')}}</div>
                        <div>{{__('client.phone_number')}}</div>
                        <div>{{__('client.address')}}</div>
                    </div>
                    <div class="info flex">
                        <div>{{$user->name}}</div>
                        <div>{{$user->profile->phone}}</div>
                        <div>{{$user->profile->address}}</div>
                    </div>
                </div>
            </div>--}}
        </div>
        <div id="tabs_content_order" class="profile_tabs_content">
            <div class="title">{{__('client.order_history')}}</div>
            <div class="order_table">
                <div class="head flex">
                    <div class="c2">{{__('client.order_id')}}</div>
                    <div class="c2">{{__('client.order_date')}}</div>
                    <div class="c2">{{__('client.order_price')}}</div>
                    <div class="c2">{{__('client.order_status')}}</div>
                    <div class="c2">{{__('client.order_view')}}</div>
                </div>
                @foreach($orders as $order)
                    <div class="ordered_item flex">
                        <div class="c2">{{$order->id}}</div>
                        <div class="c2">{{$order->created_at}}</div>
                        <div class="c2">₾{{round($order->total_price/100,2)}}</div>
                        @if($order->status==\App\Models\Order::STATUS_PENDING)
                            <div class="c2 green">{{__('client.pending')}}</div>
                        @elseif($order->status==\App\Models\Order::STATUS_FAIL)
                            <div class="c2 red">{{__('client.fail')}}</div>
                        @else
                            <div class="c2 green">{{__('client.success')}}</div>

                        @endif
                        <a
                            href="{{route('orderDetails',[app()->getLocale(),$order->id])}}"
                            class="c2 dl view_order_detail"
                        >
                            <img src="/img/icons/profile/view.svg" alt=""/>
                        </a>
                    </div>
                @endforeach
            </div>
            {{$orders->appends(request()->query())->links('vendor.pagination.orders')}}
        </div>
        <div class="profile_tabs_content">
            <div class="title">{{__('client.change_your_password')}}</div>
            <form method="post" action="{{route('changePassword',app()->getLocale())}}">
                @csrf
                <div class="input_grid">
                    <div class="input ">
                        <button type="button" class="togglePassword">
                            <img src="/img/icons/profile/eye.png" alt="">
                        </button>
                        <label for="">{{__('client.old_password')}}</label>
                        <input class="passwordInput" value="{{old('old_password')}}" class="{{$errors->has('old_password')?"invalid":""}}"
                               name="old_password" type="password" placeholder=""/>
                        @if ($errors->has('old_password'))
                            <p class="profile-error-block">{{ $errors->first('old_password') }}</p>
                        @endif
                    </div>
                    <div></div>
                    <div class="input ">
                        <button type="button" class="togglePassword">
                            <img src="/img/icons/profile/eye.png" alt="">
                        </button>
                        <label for="">{{__('client.new_password')}}</label>
                        <input class="passwordInput" value="{{old('password')}}" class="{{$errors->has('password')?"invalid":""}}"
                               name="password" type="password" placeholder=""/>
                        @if ($errors->has('password'))
                            <p class="profile-error-block">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="input ">
                        <button type="button" class="togglePassword">
                            <img src="/img/icons/profile/eye.png" alt="">
                        </button>
                        <label for="">{{__('client.repeat_password')}}</label>
                        <input class="passwordInput" value="{{old('password_repeat')}}"
                               class="{{$errors->has('password_repeat')?"invalid":""}}" name="password_repeat"
                               type="password" placeholder=""/>
                        @if ($errors->has('password_repeat'))
                            <p class="profile-error-block">{{ $errors->first('password_repeat') }}</p>
                        @endif
                    </div>
                </div>
                <button class="update">{{__('client.update')}}</button>
            </form>
        </div>
    </section>
    <div class="commonPopup subscribe_popup "  id="changePasswordPopup">
        <div class="commonPopupContainer ">
            <div class="flex center success">
                <img src="/img/icons/tick.png" alt="" />
                <div>Success!</div>
            </div>
            <p>Your password has been successfully changed.</p>
            <div class="flex center btnflex">
                <a href="#">
                    <button style="background-color:#3db39d41 ;">Go To Dashboard</button>
                </a>
                <a href="#">
                    <button>Back To Home Page</button>
                </a>
            </div>
        </div>
    </div>
     <script>

            const fileIn = document.getElementById("userAvatarInput");
            const fileOut = document.getElementById("userAvatarImg");
            const readUrl = (event) => {
                if (event.files && event.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (event) => (fileOut.src = event.target.result);
                    reader.readAsDataURL(event.files[0]);
                }
            };
            fileIn.onchange = function() {
                readUrl(this);

                const formData = new FormData();
                formData.append('avatar',this.files[0]);
                formData.append('_token','{{csrf_token()}}');
                $.ajax({
                    url: '{{route('avatar',app()->getLocale())}}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data){
                        console.log(data)
                    }
                });
            };



     </script>

@endsection

@push('script')
    <script>
        let cities = @json($cities);
        console.log(cities);
        $(document).on('change','[name="country_id[]"]',function (e){
            let $this = $(this);
            let id = $this.val();
            $this.parents('.addressFieldsChild').find('[name="city_id[]"]').html('');
            $this.parents('.addressFieldsChild').find('[name="city_id[]"]').append('<option value=""></option>');
            cities[id].forEach(function (el){
                $this.parents('.addressFieldsChild').find('[name="city_id[]"]').append('<option value="' + el.id + '">' + el.language.title + '</option>');
            });
        });
    </script>
@endpush
