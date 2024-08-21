import formatPrice from "./format_price";
import menu from "./menu";
import changeCity from "./change_city";

export function scripts() {
    changeCity();
    menu();
    formatPrice('#price-input');
}