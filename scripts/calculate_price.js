let qtyToPrice = {};
let itemPrices = {};

function setPrice(priceId, qtyId, totalId) {
    let change = document.getElementById(priceId);
    qtyToPrice[qtyId] = change.value;
    calculateSubTotal(qtyId, totalId);
}

function calculateSubTotal(qtyId, totalId) {
    let quantityInput = document.getElementById(qtyId);
    let quantity = parseInt(quantityInput.value, 10);
    if (!(qtyId in qtyToPrice)) {
        document.getElementById(totalId).value = "Please Select a Price."
    }
    else if (quantity<0 || quantityInput.value==="-0"){
        alert("Quantity cannot be negative or invalid input");
        quantityInput.value=0;
        document.getElementById(totalId).value = "0.00";
    }
    else {
        let subTotalPrice = quantity * qtyToPrice[qtyId];
        itemPrices[qtyId] = subTotalPrice;
        document.getElementById(totalId).value = subTotalPrice.toFixed(2);
        calculateTotal();
    }
}

function calculateTotal() {
    let sum = 0
    for (let key in itemPrices) {
        sum += itemPrices[key];
    }
    document.getElementById("totalPrice").value = sum.toFixed(2);
    totalPrice = document.getElementById("totalPrice").value;
    var checkoutButton = document.getElementById("checkout");
    if (totalPrice === '0.00') {
        checkoutButton.disabled = true;
    } else {
        checkoutButton.disabled = false;
    }
}

function handleRadio(productName,selectedRadio){
    const radios = document.querySelectorAll('[name^="' + productName+ '"]');
    radios.forEach(function(radio){
        if(radio !==selectedRadio){
        radio.checked=false;
        }
    });

}
function validateInput(input){
    if(input.value<0 || input.value==="-0"){
        alert("Price cannot be negative or invalid input");
        input.value=0;
    }
}