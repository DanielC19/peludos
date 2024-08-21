
const changeCity = () => {
    let d = document.getElementById("city");
    let wcity = document.getElementById("wcity");

    d.addEventListener('change', (e) => {
        let city = d.value;
        wcity.value = city;
    });
}

export default changeCity;