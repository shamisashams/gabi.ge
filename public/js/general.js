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
  value < 1 ? (value = 1) : "";
  value--;
  document.getElementById("product_number").value = value;
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
