function changeTotalPrice(el) {
    let total = document.querySelector("#total-price");
    let ship = 0;
    if($("input[type='radio'][name='address']:checked").data('ship') !== undefined){
        ship = $("input[type='radio'][name='address']:checked").data('ship');
    }

    if(el.value == 'from_office'){
        ship = 0;
    }
    //alert(ship)
    document.getElementById('to_address_price').innerHTML = "₾" + ship.toFixed(2);
    /*let price =
        parseFloat(total.getAttribute("data-price")) +
        parseFloat(el.getAttribute("data-price"));*/
    let price =
        parseFloat(total.getAttribute("data-price")) +
        ship
    total.textContent = "₾" + price.toFixed(2);
}
function changeTotalPrice2(el) {
    let total = document.querySelector("#total-price");
    let ship = $(el).data('ship');

    //alert(ship)
    //alert($("input[type='radio'][name='shipping']:checked").val());
    if($("input[type='radio'][name='shipping']:checked").val() == 'from_office' || $("input[type='radio'][name='shipping']:checked").val() ===undefined){
        ship = 0;
    }
    //alert(ship)
    document.getElementById('to_address_price').innerHTML = "₾" + ship.toFixed(2);
    /*let price =
        parseFloat(total.getAttribute("data-price")) +
        parseFloat(el.getAttribute("data-price"));*/
    let price =
        parseFloat(total.getAttribute("data-price")) +
        ship
    total.textContent = "₾" + price.toFixed(2);
}

function showBank() {
    const pmmtBanks = document.querySelector(".banks_pmmt");
    pmmtBanks.classList.toggle("shown");
}

function hideBank() {
    const pmmtBanks = document.querySelector(".banks_pmmt");
    pmmtBanks.classList.remove("shown");
}

// preloader

window.addEventListener("load", () => {
    document.getElementById("preloader").classList.add("hide");
});
