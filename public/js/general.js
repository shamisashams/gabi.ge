// Variables

const lisuNav = document.querySelectorAll(".lisu_navigation");
const lisuForm = document.querySelectorAll(".lisu_form_alt");
const lisuCurrent = document.querySelectorAll(".current_lisu");
const moreAge = document.getElementById("show_more_age");
const moreSize = document.getElementById("show_more_size");
const extraAge = document.querySelector(".extra_age");
const extraSize = document.querySelector(".extra_size");
const cartItems = document.querySelectorAll(".cart_item_header");
const removeItem = document.querySelectorAll(".remove_item");
const categoryList = document.querySelectorAll(".category_list");
const CategoryImg = document.querySelectorAll(".category_img");
const fvSliderItem = document.querySelectorAll(".fullview_slider_item");
const lgImgView = document.querySelectorAll(".large_image_view");
const infoHead = document.querySelectorAll(".info_head");
const infoContent = document.querySelectorAll(".information_content");
const helpCategory = document.querySelectorAll(".help_category");
const helpContent = document.querySelectorAll(".help_content");
const qAndA = document.querySelectorAll(".q_and_a");
const cartItemShop = document.querySelectorAll(".cart_item_shoppingcart");
const removeItemCart = document.querySelectorAll(".remove_item_cart");
const profileTabName = document.querySelectorAll(".profile_tab_name");
const profileTabContent = document.querySelectorAll(".profile_tabs_content");
const color = document.querySelectorAll(".color");
const menuBtn = document.querySelector(".menu_btn");
const closeMenu = document.querySelector(".close_menu");
const addCart = document.querySelector(".popup_add_to_cart");
const success = document.querySelector(".popup_success");
const popUpBg = document.querySelector(".popup_bg");
const closePopup = document.querySelector(".close_popup");
const mainProductView = document.querySelectorAll(".main_product_view");


const locale = $('meta[name="language"]').attr('content');

// sidebar filters show more

if (moreAge) {
    moreAge.addEventListener("click", function () {
        extraAge.classList.toggle("show");
    });

    moreSize.addEventListener("click", function () {
        extraSize.classList.toggle("show");
    });
}

// login signup content

lisuNav.forEach((el, i) => {
    el.addEventListener("click", () => {
        // clear all
        lisuNav.forEach((el) => {
            el.classList.remove("active");
        });
        lisuForm.forEach((el) => {
            el.classList.remove("opened");
        });
        lisuCurrent.forEach((el) => {
            el.classList.remove("on");
        });

        // show one
        lisuNav[i].classList.add("active");
        lisuForm[i].classList.add("opened");
        lisuCurrent[i].classList.add("on");
    });
});

// remove item from cart - header dropdown

removeItem.forEach((el, i) => {
    el.addEventListener("click", () => {
        cartItems[i].style.display = "none";
    });
});

// remove item from cart - shopping cart

removeItemCart.forEach((el, i) => {
    el.addEventListener("click", () => {
        cartItemShop[i].style.display = "none";
    });
});

//  category dropdown

categoryList.forEach((el, i) => {
    el.addEventListener("mouseenter", () => {
        // clear all
        categoryList.forEach((el) => {
            el.classList.remove("active");
        });
        CategoryImg.forEach((el) => {
            el.classList.remove("display");
        });

        // show one
        categoryList[i].classList.add("active");
        CategoryImg[i].classList.add("display");
    });
});

// vertical slider images

fvSliderItem.forEach((el, i) => {
    el.addEventListener("click", () => {
        fvSliderItem.forEach((el) => {
            el.classList.remove("active");
        });
        lgImgView.forEach((el) => {
            el.classList.remove("display");
        });

        fvSliderItem[i].classList.add("active");
        lgImgView[i].classList.add("display");
    });
});

// information content

infoHead.forEach((el, i) => {
    el.addEventListener("click", () => {
        infoHead.forEach((el) => {
            el.classList.remove("clicked");
        });
        infoContent.forEach((el) => {
            el.classList.remove("clicked");
        });

        infoHead[i].classList.add("clicked");
        infoContent[i].classList.add("clicked");
    });
});

// help center content

helpCategory.forEach((el, i) => {
    el.addEventListener("click", () => {
        helpCategory.forEach((el) => {
            el.classList.remove("clicked");
        });
        helpContent.forEach((el) => {
            el.classList.remove("clicked");
        });

        helpCategory[i].classList.add("clicked");
        helpContent[i].classList.add("clicked");
    });
});

// q and a

if (qAndA) {
    qAndA.forEach((el) => {
        el.addEventListener("click", () => {
            el.classList.toggle("open");
        });
    });
}


// popup success

if (addCart) {
    addCart.addEventListener("click", () => {
        success.classList.add("done");
    });
}

// open popup

mainProductView.forEach((el) => {
    el.addEventListener("click", () => {
        popUpBg.classList.add("open");
    });
});

// close popup

if (closePopup) {
    closePopup.addEventListener("click", () => {
        popUpBg.classList.remove("open");
    });
}


//  product amount

function increaseValue() {
    let value = parseInt(document.getElementById("product_number").value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById("product_number").value = value;
}

function decreaseValue() {
    let value = parseInt(document.getElementById("product_number").value, 10);
    value = isNaN(value) ? 0 : value;
    value--;
    value < 1 ? (value = 1) : "";
    document.getElementById("product_number").value = value;
}


function increase(id, options) {

    let value = parseInt(document.getElementById(`product_number-${id}-${JSON.stringify(options)}`).value, 10);

    addcartcount(id, options, +1)
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById(`product_number-${id}-${JSON.stringify(options)}`).value = value;
}

function decrease(id, options) {
    let value = parseInt(document.getElementById(`product_number-${id}-${JSON.stringify(options)}`).value, 10);

    value = isNaN(value) ? 0 : value;
    value--;
    let type = value < 1 ? 0 : -1;
    value < 1 ? (value = 1) : "";
    addcartcount(id, options, type)

    document.getElementById(`product_number-${id}-${JSON.stringify(options)}`).value = value;
}

// profile tab content

profileTabName.forEach((el, i) => {
    el.addEventListener("click", () => {
        profileTabName.forEach((el) => {
            el.classList.remove("clicked");
        });
        profileTabContent.forEach((el) => {
            el.classList.remove("clicked");
        });

        profileTabName[i].classList.add("clicked");
        profileTabContent[i].classList.add("clicked");
    });
});

// mobile menu

menuBtn.addEventListener("click", () => {
    document.querySelector(".header_content").style.top = "0";
});
closeMenu.addEventListener("click", () => {
    document.querySelector(".header_content").style.top = "-100%";
});
$(document).ready(function () {
    getCartCount();
});

function addToCart(el, $id) {
    let object = {};
    let box = document.querySelector('.customize');
    if (box) {
        let quantity = document.querySelector('#product_number').value;
        let options = box.querySelectorAll('input[type="radio"]:checked');
        let allOptions = box.querySelectorAll('.title');
        options.forEach(item => {
            if (item.getAttribute('data-feature')) {
                object[item.getAttribute('data-feature')] = item.value;
            }
        })

        if (allOptions.length === options.length) {
            addToCartAjax($id, object, quantity);
        }
    }

};

function addToCartAjax($id, options, quantity) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `/${locale}/addtocart/` + $id + `?options=${JSON.stringify(options)}&quantity=${quantity}`,
        method: 'GET',
        success: function (data) {
            if (data.status == true) {
                getCartCount();
            }
        }
    });
}

function getCartCount() {

    $.ajax({
        url: `/${locale}/getcartcount/`,
        method: 'GET',
        success: function (data) {
            if (data.status == true) {
                $('#cart-count').text(data.count + " / $" + (data.total.toFixed(2) * 100) / 100);
                let cart = document.querySelectorAll('.cart_item_header');
                let cartDropDown = document.querySelector('.cart_dropdown');
                cartDropDown.innerHTML = "";
                data.products.forEach(item => {
                    let element = `

                        <div class="item cart_item_header">
                          <a style="display: contents" href="/${locale}/catalogue/${item.category_id}/details/${item.id}"">
                        <div>
                            <div class="title">${item.title}</div>
                            <div class="number">${item.quantity} x $${item.sale ? item.sale : item.price}</div>
                        </div>
                        <div class="picture">
                            <img src="/storage/product/${item.id}/${item.file}" alt=""/>
                        </div>
                          </a>

                        <button type="button" class="remove_item" onclick="removefromcart(this,${item.id})">
                            <p hidden>${item.options}</p>
                            <img src="/img/icons/header/remove.png" alt=""/>
                        </button>
                    </div>
                 `
                    $(cartDropDown).append(element);

                    // cartDropDown.insertBefore('<div></div>', checkoutTotal);
                })
                let checkout = `
                                    <div class="checkout" id="checkout-total">
                        <div class="total">total</div>
                        <div class="price">$ ${Math.round(data.total * 100) / 100}</div>
                    </div>
                    <div class="checkout">
                        <a href="/${locale}/cart">
                            <button class="view_cart">View Cart</button>
                        </a>
                        <a href="shopping-cart.html">
                            <button class="go">
                                <div>Checkout</div>
                                <img src="/img/icons/header/right.png" alt=""/>
                            </button>
                        </a>
                    </div>`
                $(cartDropDown).append(checkout);

                $('#sub-total').text(`$${data.total.toFixed(2)}`);


                // $('#cart_count').text(data.count);
                // $('#cart_price').text(`${data.total}₾`)

                // $('#step_product_price').text(`${data.total}₾`)
                // $('#step_product_total').text(`${data.total}₾`)
                //
                // $('#step_2_product_price').text(`${data.total}₾`)
                // $('#step_2_product_total').text(`${data.total}₾`)
                //
                // $('#step_3_product_price').text(`${data.total}₾`)
                // $('#step_3_product_total').text(`${data.total}₾`)

                $('#cart_total').text(`${data.total}₾`)


                data.products.forEach((el) => {

                    let element = document.getElementById(`cart_product_total-${el.id}-${el.options}`);

                    if (el.sale) {
                        $(element).text(`$ ${(el.sale * el.quantity).toFixed(2)}`)
                        // $(`#cart_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                        //  $(`#cart_2_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                        //  $(`#cart_3_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                    } else {
                        $(element).text(`$ ${(el.price * el.quantity).toFixed(2)}`)
                    }

                })
            }
        }
    });
}

function addcartcount(id, options, type) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `/${locale}/addcartcount/` + id + "/" + type + "?options=" + JSON.stringify(options),
        method: 'GET',
        success: function (data) {
            if (data.status == true) {
                getCartCount();
            }
        }
    });
}

function removefromcart(el = null, id, options = null) {

    let features = el ? JSON.parse(el.firstElementChild.textContent) : (options ? options : "")


    if (features) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/${locale}/removefromcart`,
            method: 'GET',
            data: {
                id,
                features: JSON.stringify(features)
            },
            success: function (data) {
                if (data.status === true) {
                    let productItem = document.getElementById(`product_item-${id}-${JSON.stringify(features)}`);
                    console.log(productItem);
                    if (productItem) {
                        productItem.remove();
                    }

                    getCartCount();
                }
            }
        });
    }
}

function changeType(type) {

    let url = new URL(window.location.href);

    let params = url.searchParams;
    params.set('type', type);

    url.search = params.toString();

    window.history.pushState('', '', url.toString());
    console.log(url.toString())

}

let params = (new URL(window.location.href)).searchParams.get('type');
let profile = document.querySelector('#tab-profile');
let order = document.querySelector('#tab-order');
let password = document.querySelector('#tab-password');
if (params === 'profile') {
    profile.click();
}
if (params === 'order') {
    order.click();
}
if (params === 'password') {
    password.click();

}

