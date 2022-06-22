$(".hero_slideshow").slick({
    draggable: true,
    arrows: false,
    dots: true,
    fade: true,
    speed: 900,
    autoplay: true,
    autoSpeed: 4000,
    infinite: true,
    cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
    touchThreshold: 100,
    pauseOnHover: false,
});

$(".best_seller_slide").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    draggable: true,
    arrows: true,
    nextArrow: "#next_bs",
    prevArrow: "#prev_bs",
    dots: false,
    speed: 300,
    autoplay: false,
    infinite: true,
    cssEase: "linear",

    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 830,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
            },
        },
    ],
});

$(".new_products_slide").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    draggable: true,
    arrows: true,
    nextArrow: "#next_np",
    prevArrow: "#prev_np",
    dots: false,
    speed: 300,
    autoplay: false,
    infinite: true,
    cssEase: "linear",

    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 830,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
            },
        },
    ],
});

$(".category_slide").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    draggable: true,
    arrows: true,
    nextArrow: ".cat_slide_btn_next",
    prevArrow: ".cat_slide_btn_prev",
    dots: false,
    speed: 300,
    autoplay: false,
    infinite: true,
    cssEase: "linear",

    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 1,
            },
        },
    ],
});

// $(".pagination_slides").slick({
//   slidesToShow: 4,
//   slidesToScroll: 1,
//   arrows: true,
//   nextArrow: ".next_page",
//   prevArrow: ".prev_page",
//   dots: false,
//   draggable: false,
//   infinite: false,
//   autoplay: false,
//   speed: 100,
// });

$(".vertical_slider_view").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: true,
    nextArrow: "#arrow_slide_down",
    prevArrow: "#arrow_slide_up",
    dots: false,
    vertical: true,
    draggable: true,
    infinite: false,
    autoplay: false,
    speed: 100,

    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 4,
            },
        },
    ],
});
