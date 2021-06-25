function changeTotalPrice(el) {
    let total = document.querySelector('#total-price');
    let price = parseFloat(total.getAttribute('data-price')) + parseFloat(el.getAttribute('data-price'));
    total.textContent = '$' + price;
}
