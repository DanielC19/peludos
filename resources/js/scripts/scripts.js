import formatPrice from "./format_price";
import menu from "./menu";

export function scripts() {
    menu();
    formatPrice('#price-input');
}