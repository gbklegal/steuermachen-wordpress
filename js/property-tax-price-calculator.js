window.addEventListener('load', () => {
    const bjeInput = document.querySelector('#bje');
    if (!bjeInput) return;
    const bjeResult = document.querySelector('#bjePrice');
    const orderNowBtn = document.querySelector('#priceCalculator .order-now');

    let cache = null;

    function renderPrice() {
        let priceCalc = new PriceCalculator();
        // global_priceCalc = priceCalc; // TODO: remove in prod.
        let price = priceCalc.getPropertyTaxPrice(bjeInput.value);
        let formattedPrice = (price === false ? 'X' : priceCalc.formatCurrency(price));

        if (!cache)
            cache = orderNowBtn.href;

        orderNowBtn.href = cache + bjeInput.value;

        if (bjeInput.value == '')
            return;

        // bjeResult.innerHTML = `<span class="h3">${formattedPrice}</span>&nbsp;Euro`;
        bjeResult.innerHTML = `${formattedPrice}&nbsp;Euro`;
    }

    bjeInput.addEventListener('input', renderPrice);
    renderPrice();
});