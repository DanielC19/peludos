import numeral from "numeral";

const formatPrice = (input) => {
    let add_pay = '#add-pay';
    let d = document;
    let $price_input = d.querySelector(input);
    let $add_pay_input = d.querySelector(add_pay)

    d.addEventListener('input', (e) => {
        if (e.target.matches(input)) {
            let price = $price_input.value
            let priceFormatted = numeral(price).format('$0,0')
            $price_input.value = priceFormatted
        }
    });

    d.addEventListener('input', (e) => {
        if (e.target.matches(add_pay)) {
            let price = $add_pay_input.value
            let priceFormatted = numeral(price).format('$0,0')
            $add_pay_input.value = priceFormatted
        }
    });
}
export default formatPrice;