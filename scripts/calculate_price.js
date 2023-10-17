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
    else if (quantity<0){
        alert("Quantity must be greater than or equal to 0");
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