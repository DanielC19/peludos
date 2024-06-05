import './bootstrap';
import { scripts } from "./scripts/scripts";

const d = document;
d.addEventListener('DOMContentLoaded', () => {
    /**
     * * Run all scripts
     * Their work is to give functionality of reactivity to a certain element
     */
    scripts();
});