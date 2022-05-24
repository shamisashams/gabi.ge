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
const lgImgView = document.querySelectorAll(".magnified_img");
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

const popUpBg = document.querySelector(".popup_bg");
const closePopup = document.querySelector(".close_popup");
const mainProductView = document.querySelectorAll(".view_popup_product");

let timeout;

const locale = $('meta[name="language"]').attr("content");

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

// if (addCart) {
//     addCart.addEventListener("click", () => {
//         success.classList.add("done");
//     });
// }

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

function increaseValue(type = null) {
    let value =
        type === "details"
            ? parseInt(document.getElementById("product_numb").value, 10)
            : parseInt(document.getElementById("product_number").value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    type === "details"
        ? (document.getElementById("product_numb").value = value)
        : (document.getElementById("product_number").value = value);
}

function decreaseValue(type = null) {
    let value =
        type === "details"
            ? parseInt(document.getElementById("product_numb").value, 10)
            : parseInt(document.getElementById("product_number").value, 10);

    value = isNaN(value) ? 0 : value;
    value--;
    value < 1 ? (value = 1) : "";
    type === "details"
        ? (document.getElementById("product_numb").value = value)
        : (document.getElementById("product_number").value = value);
}

function increase(id, options) {
    let value = parseInt(
        document.getElementById(
            `product_number-${id}-${JSON.stringify(options)}`
        ).value,
        10
    );

    addcartcount(id, options, +1);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById(
        `product_number-${id}-${JSON.stringify(options)}`
    ).value = value;
}

function decrease(id, options) {
    let value = parseInt(
        document.getElementById(
            `product_number-${id}-${JSON.stringify(options)}`
        ).value,
        10
    );

    value = isNaN(value) ? 0 : value;
    value--;
    let type = value < 1 ? 0 : -1;
    value < 1 ? (value = 1) : "";
    addcartcount(id, options, type);

    document.getElementById(
        `product_number-${id}-${JSON.stringify(options)}`
    ).value = value;
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
    checkSelection_alert_p();
    let object = {};
    let box = document.querySelector("#customize");
    if (box) {
        let quantity = document.querySelector("#product_number").value;
        let options = box.querySelectorAll('input[type="radio"]:checked');
        let allOptions = box.querySelectorAll(".title");
        options.forEach((item) => {
            if (item.getAttribute("data-feature")) {
                object[item.getAttribute("data-feature")] = item.value;
            }
        });

        if (allOptions.length === options.length) {
            addToCartAjax($id, object, quantity);
        }
    }
}

function addToCartProductDetails(el, $id) {
    checkSelection_alert();
    let object = {};
    let box = document.querySelector("#customize-details");
    if (box) {
        let quantity = document.querySelector("#product_numb").value;
        let options = box.querySelectorAll('input[type="radio"]:checked');
        let allOptions = box.querySelectorAll(".title");
        options.forEach((item) => {
            if (item.getAttribute("data-feature")) {
                object[item.getAttribute("data-feature")] = item.value;
            }
        });

        if (allOptions.length === options.length) {
            addToCartAjax($id, object, quantity);
            document.querySelector(".product_added").classList.add("show");
            setTimeout(() => {
                document
                    .querySelector(".product_added")
                    .classList.remove("show");
            }, 5000);
        }
    }
}

function addToCartAjax($id, options, quantity) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url:
            `/${locale}/addtocart/` +
            $id +
            `?options=${JSON.stringify(options)}&quantity=${quantity}`,
        method: "GET",
        success: function (data) {
            if (data.status == true) {
                let success = document.querySelector(".popup_success");
                let closePopupBg = document.querySelector(".close_popup_bg");
                if (success) {
                    success.classList.add("done");
                    timeout = setTimeout(function () {
                        closePopupBg.click();
                    }, 3000);
                }

                getCartCount();
            }
        },
    });
}

function getCartCount() {
    $.ajax({
        url: `/${locale}/getcartcount/`,
        method: "GET",
        success: function (data) {
            if (data.status == true) {
                $("#cart-count").text(
                    data.count + " / ₾" + (data.total.toFixed(2) * 100) / 100
                );
                let cart = document.querySelectorAll(".cart_item_header");
                let cartDropDown = document.querySelector(".cart_dropdown");
                cartDropDown.innerHTML = "";
                data.products.forEach((item) => {
                    let element = `

                        <div class="item cart_item_header">
                          <a style="display: contents" href="/${locale}/product/${
                        item.cat_slug
                    }/${item.prod_slug}"">
                        <div>
                            <div class="title">${item.title}</div>
                            <div class="number">${item.quantity} x ₾${
                        item.sale ? item.sale : item.price
                    }</div>
                        </div>
                        <div class="picture">
                            <img src="/storage/product/${item.id}/thumb/${
                        item.file
                    }" alt=""/>
                        </div>
                          </a>

                        <button type="button" class="remove_item" onclick="removefromcart(this,${
                            item.id
                        })">
                            <p hidden>${item.options}</p>
                            <img src="/img/icons/header/remove.png" alt=""/>
                        </button>
                    </div>
                 `;
                    $(cartDropDown).append(element);

                    // cartDropDown.insertBefore('<div></div>', checkoutTotal);
                });
                let checkout = `
                                    <div class="checkout" id="checkout-total">
                        <div class="total">${__('client.total')}</div>
                        <div class="price">₾ ${
                            Math.round(data.total * 100) / 100
                        }</div>
                    </div>
                    <div class="checkout">
                        <!--<a href="/${locale}/cart">
                            <button class="view_cart">View Cart</button>
                        </a>//-->
                        <a href="/${locale}/cart">
                            <button class="go">
                                <div>${__('client.checkout')}</div>
                                <img src="/img/icons/header/right.png" alt=""/>
                            </button>
                        </a>
                    </div>`;
                $(cartDropDown).append(checkout);

                $("#sub-total").text(`₾${data.total.toFixed(2)}`);
                $("#total-price").text(`₾${data.total.toFixed(2)}`);
                $("#total-price").attr("data-price", data.total.toFixed(2));

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

                $("#cart_total").text(`${data.total}₾`);

                data.products.forEach((el) => {
                    let element = document.getElementById(
                        `cart_product_total-${el.id}-${el.options}`
                    );

                    if (el.sale) {
                        $(element).text(
                            `₾ ${(el.sale * el.quantity).toFixed(2)}`
                        );
                        // $(`#cart_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                        //  $(`#cart_2_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                        //  $(`#cart_3_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                    } else {
                        $(element).text(
                            `₾ ${(el.price * el.quantity).toFixed(2)}`
                        );
                    }
                });
            }
        },
    });
}

function addcartcount(id, options, type) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url:
            `/${locale}/addcartcount/` +
            id +
            "/" +
            type +
            "?options=" +
            JSON.stringify(options),
        method: "GET",
        success: function (data) {
            if (data.status == true) {
                getCartCount();
            }
        },
    });
}

function removefromcart(el = null, id, options = null) {
    let features = el
        ? JSON.parse(el.firstElementChild.textContent)
        : options
        ? options
        : "";

    if (features) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: `/${locale}/removefromcart`,
            method: "GET",
            data: {
                id,
                features: JSON.stringify(features),
            },
            success: function (data) {
                if (data.status === true) {
                    let productItem = document.getElementById(
                        `product_item-${id}-${JSON.stringify(features)}`
                    );
                    if (productItem) {
                        productItem.remove();
                    }

                    getCartCount();
                }
            },
        });
    }
}

function changeType(type) {
    let url = new URL(window.location.href);

    let params = url.searchParams;
    params.set("type", type);

    url.search = params.toString();

    window.history.pushState("", "", url.toString());
    console.log(url.toString());
}

let params = new URL(window.location.href).searchParams.get("type");
let profile = document.querySelector("#tab-profile");
let order = document.querySelector("#tab-order");
let password = document.querySelector("#tab-password");
if (params === "profile") {
    profile.click();
}
if (params === "order") {
    order.click();
}
if (params === "password") {
    password.click();
}
//checkProductDetailsSelection();

function checkProductDetailsSelection() {
    let box = document.querySelector("#customize-details");
    let buttons = document.querySelector(".btns");
    if (box) {
        let answers = box.querySelectorAll('input[type="radio"]');
        let allOptions = box.querySelectorAll(".title");
        answers.forEach((item) => {
            item.onchange = function () {
                let options = box.querySelectorAll(
                    'input[type="radio"]:checked'
                );
                if (allOptions.length === options.length) {
                    buttons.querySelector(".add_to_cart").disabled = false;
                }
            };
        });
        if (
            allOptions.length ===
            box.querySelectorAll('input[type="radio"]:checked').length
        ) {
            buttons.querySelector(".add_to_cart").disabled = false;
        }
    }
}

function checkSelection() {
    let box = document.querySelector("#customize");
    let buttons = document.querySelector(".btm_btns");
    if (box) {
        let answers = box.querySelectorAll('input[type="radio"]');
        let allOptions = box.querySelectorAll(".title");
        answers.forEach((item) => {
            item.onchange = function () {
                let options = box.querySelectorAll(
                    'input[type="radio"]:checked'
                );
                if (allOptions.length === options.length) {
                    buttons.querySelector(".add_to_cart").disabled = false;
                }
            };
        });
        if (
            allOptions.length ===
            box.querySelectorAll('input[type="radio"]:checked').length
        ) {
            buttons.querySelector(".add_to_cart").disabled = false;
        }
    }
}

function checkSelection_alert() {
    let box = document.querySelector("#customize-details");
    let buttons = document.querySelector(".btm_btns");
    if (box) {
        let answers = box.querySelectorAll('input[type="radio"]');
        let allOptions = box.querySelectorAll(".title");
        answers.forEach((item) => {
            item.onchange = function () {
                let options = box.querySelectorAll(
                    'input[type="radio"]:checked'
                );

                /*if (allOptions.length !== options.length) {

                }*/
                options.forEach(function (el, i) {
                    //console.log(el)
                    $(el)
                        .parents(".options")
                        .find(".title")
                        .css("color", "black");
                });
            };
        });
        if (
            allOptions.length !==
            box.querySelectorAll('input[type="radio"]:checked').length
        ) {
            let not_checked = $('input[type="radio"]:not(:checked)');
            //console.log(not_checked)
            not_checked.each(function (i, el) {
                //console.log(el)

                if (
                    $(el)
                        .parents(".options")
                        .find('input[type="radio"]:checked').length < 1
                ) {
                    $(el)
                        .parents(".options")
                        .find(".title")
                        .css("color", "red");
                }
            });

            return false;
        }
    }
}

function checkSelection_alert_p() {
    let box = document.querySelector("#customize");
    let buttons = document.querySelector(".btm_btns");
    if (box) {
        let answers = box.querySelectorAll('input[type="radio"]');
        let allOptions = box.querySelectorAll(".title");
        answers.forEach((item) => {
            item.onchange = function () {
                let options = box.querySelectorAll(
                    'input[type="radio"]:checked'
                );
                /*if (allOptions.length !== options.length) {
                    alert('select options')
                    return false;
                }*/
                options.forEach(function (el, i) {
                    //console.log(el)
                    $(el)
                        .parents(".options")
                        .find(".title")
                        .css("color", "black");
                });
            };
        });
        if (
            allOptions.length !==
            box.querySelectorAll('input[type="radio"]:checked').length
        ) {
            let not_checked = $('input[type="radio"]:not(:checked)');
            //console.log(not_checked)
            not_checked.each(function (i, el) {
                //console.log(el)

                if (
                    $(el)
                        .parents(".options")
                        .find('input[type="radio"]:checked').length < 1
                ) {
                    $(el)
                        .parents(".options")
                        .find(".title")
                        .css("color", "red");
                }
            });

            return false;
        }
    }
}

function addToModal(product) {
    console.log(product);
    let popupContainer = document.querySelector("#popup_bg");
    let images = "";
    let mainImages = "";
    let price = "";
    let features = "";
    if (product.files) {
        product.files.forEach((item) => {
            images = images.concat(`
              <div class="small_img_popup flex center">
                 <img src="/storage/product/${item.fileable_id}/thumb/${item.name}" alt="" />
              </div>
        `);
        });

        product.files.forEach((item, i) => {
            mainImages = mainImages.concat(`
                <img class="main_img_popup ${
                    i === 0 ? "display" : ""
                }" src="/storage/product/${item.fileable_id}/${
                item.name
            }" alt="" />
            `);
        });
    }

    if (product.sale_product && product.sale_product.sale) {
        let sale = product.sale_product.sale;
        price = `
               <div class="main">
                 ₾ ${
                     sale.type == "fixed"
                         ? (product.prcie / 100 - sale.discount).toFixed(2)
                         : (
                               product.price / 100 -
                               ((product.price / 100) * sale.discount) / 100
                           ).toFixed(2)
                 }
               </div>
               <div class="last">₾ ${(product.price / 100).toFixed(2)}</div>
               <div class="off">
                  -${
                      sale.type == "percent"
                          ? sale.discount
                          : (
                                (sale.discount * 100) /
                                (product.price / 100)
                            ).toFixed(2)
                  }%
               </div>
               `;
    } else {
        price = `
            <div class="main">₾ ${(product.price / 100).toFixed(2)}</div>
`;
    }

    getProductFeatures(product.id, function (productAnswers, productFeatures) {
        for (const key in productFeatures) {
            if (productFeatures.hasOwnProperty(key)) {
                let productAnswer = productFeatures[key];
                let options = "";
                if (
                    productAnswer.feature.type === "input" ||
                    (productAnswer.feature.english_language.length > 0
                        ? productAnswer.feature.english_language[0].title ==
                          "category"
                        : "")
                ) {
                    continue;
                }
                productAnswer.feature.answer.forEach((answer) => {
                    if (answer.status && productAnswers.includes(answer.id)) {
                        options = options.concat(`
                            <div class="box">
                                <input type="radio" name="feature[${
                                    productAnswer.feature.id
                                }][]"
                                       data-feature="${
                                           productAnswer.feature.id
                                       }" id="${answer.id}"
                                           value="${answer.id}"
                                 />
                                <label for="${answer.id}" class="box">
                                ${
                                    answer.available_language.length > 0
                                        ? answer.available_language[0].title
                                        : ""
                                }
                              </label>
                            </div>
                         `);
                    }
                });

                features = features.concat(`
                   <div class="options">
                        <div class="title">${
                            productAnswer.feature.available_language.length > 0
                                ? productAnswer.feature.available_language[0]
                                      .title
                                : ""
                        }</div>
                        <div class="box_grid">
                        ${options}
                        </div>
                    </div>
    `);
            }
        }

        //et disabled = productAnswers.length > 0;
        let disabled = false;
        //console.log(product.category.available_language);
        let content = `
        <div class="close_popup_bg"></div>
            <div class="product_popup">
            <div class="head flex">
                <div>${
                    product.available_language.length > 0
                        ? product.available_language[0].title
                        : ""
                }</div>
                <button onclick="popUpBg.classList.remove('open')" class="close_popup">
                    <img src="/img/icons/popup/close.png" alt="" />
                </button>
            </div>
            <div class="flex content">
                <div class="imges">
                    <div class="main flex center">
                     ${mainImages}

                    </div>
                    <div class="flex small0nes">
                        ${images}
                    </div>
                </div>
                <div class="customize" id="customize">
                    <div class="prices flex">
                      ${price}
                    </div>
                    <p><span>ID:</span> ${product.id}</p>
                    <p><span>Category:</span> ${
                        product.category.available_language.length > 0
                            ? product.category.available_language[0].title
                            : ""
                    }</p>
                    <div class="btns flex">
                        <div class="number_input">
                            <button class="decrease" onclick="decreaseValue()">-</button>
                            <input
                            disabled
                                id="product_number"
                                type="text"
                                class="number"
                                value="1"
                            />
                            <button class="increase" onclick="increaseValue()">+</button>
                        </div>
                    </div>
                    ${features}
                </div>
            </div>
            <div class="flex center btm_btns">
                <a href="/${locale}/product/${
            product.category.available_language[0].slug
        }/${product.available_language[0].slug}">
                    <button class="details">${__('client.details')}</button>
                </a>

                    <button id="add_to_cart" ${
                        disabled ? "disabled" : ""
                    } onclick="addToCart(this, ${
            product.id
        })" class="add_to_cart flex center popup_add_to_cart">
                        <img src="/img/icons/details/cart.png" alt="" />
                        <div>${__('client.add_to_cart')}</div>
                    </button>
            </div>

            <div class="success flex center popup_success">

                <img src="/img/icons/popup/success.png" alt="">
                <div>${__('client.cart_add_success')}</div>


            </div>
        </div>`;

        popupContainer.innerHTML = "";
        $(popupContainer).append(content);
        //checkSelection();
        closeModal();
    });
}

function getProductFeatures(id, callback) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: `/${locale}/getfeatures/` + id,
        method: "GET",
        success: function (data) {
            if (data.status) {
                callback(data.productAnswers, data.productFeatures);
            }
        },
    });
}

function closeModal() {
    const closePopupBg = document.querySelector(".close_popup_bg");
    const mainImgPopup = document.querySelectorAll(".main_img_popup");
    const smallImgPopup = document.querySelectorAll(".small_img_popup");

    if (closePopupBg) {
        closePopupBg.addEventListener("click", () => {
            popUpBg.classList.remove("open");
            clearTimeout(timeout);
        });
    }

    smallImgPopup.forEach((el, i) => {
        el.addEventListener("mouseenter", () => {
            mainImgPopup.forEach((el) => {
                el.classList.remove("display");
            });

            // show one
            mainImgPopup[i].classList.add("display");
        });
    });
}
