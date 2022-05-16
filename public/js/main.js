function changeTotalPrice(el) {
    let total = document.querySelector('#total-price');
    let price = parseFloat(total.getAttribute('data-price')) + parseFloat(el.getAttribute('data-price'));
    total.textContent = '₾' + price;
}


function showBank() {
    const pmmtBanks = document.querySelector(".banks_pmmt");
    pmmtBanks.classList.toggle('shown');
}

function hideBank() {
    const pmmtBanks = document.querySelector(".banks_pmmt");
    pmmtBanks.classList.remove('shown');
}
