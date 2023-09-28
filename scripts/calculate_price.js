let qtyToPrice = {};
let itemPrices = {};

function setPrice(priceId,qtyId,totalId)
{
    let change = document.getElementById(priceId);
    qtyToPrice[qtyId] = change.value;
    calculateSubTotal(qtyId,totalId);
}

function calculateSubTotal(qtyId,totalId){
    let quantityInput = document.getElementById(qtyId);
    let quantity = parseInt(quantityInput.value,10);
    if (!(qtyId in qtyToPrice))
    {
        document.getElementById(totalId).value = "Please Select a Price."
    }
    else
    {    
        let subTotalPrice = quantity*qtyToPrice[qtyId];
        itemPrices[qtyId]=subTotalPrice;
        document.getElementById(totalId).value= subTotalPrice.toFixed(2);
        calculateTotal();
    }
}

function calculateTotal()
{
    let sum=0
    for(let key in itemPrices)
    {
        sum+=itemPrices[key];
    }
    document.getElementById("totalPrice").value= sum.toFixed(2);
}

