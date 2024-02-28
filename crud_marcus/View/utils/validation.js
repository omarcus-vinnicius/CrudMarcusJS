'use strict'




var phone = document.getElementById('cellphone');

phone.addEventListener('keypress', () => {
    var clearFild = phone.value.replace(/\D/g, "").substring(0, 12);
    phone.value = clearFild;

    var lenghInput = phone.value.length;
    var numberArrey = clearFild.split("");
    var numberFormat = "";

    if (lenghInput > 0) {
        numberFormat += `(${numberArrey.slice(0, 2).join("")}) `;
    }

    if (lenghInput > 2) {
        numberFormat += `${numberArrey.slice(2, 6).join("")}-`;
    }

    if (lenghInput > 6) {
        numberFormat += `${numberArrey.slice(6, 10).join("")}`;
    }

    phone.value = numberFormat;

});



const validationForm = () => {

    return document.getElementById('modal-form').reportValidity();


}


export {
    validationForm
}