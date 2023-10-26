document.addEventListener("DOMContentLoaded", function () {
    const product0 = document.getElementById("product0");
    const textbox0 = document.getElementById("textbox0");

    const product1 = document.getElementById("product1");
    const textbox1 = document.getElementById("textbox1");

    const product2 = document.getElementById("product2");
    const textbox2 = document.getElementById("textbox2");

    product0.addEventListener("change", function () {
        generateTextbox(product0, textbox0);
    });

    product1.addEventListener("change", function () {
        generateTextbox(product1, textbox1);
    });

    product2.addEventListener("change", function () {
        generateTextbox(product2, textbox2);
    });

    function generateTextbox(checkbox, container) {
        if (checkbox.checked) {
            container.style.display = "block";
        }
        else {
            container.style.display = "none";
        }
    }

});

function validateInput(input){
    let pricePattern =/^\d+(\.\d{1,2})?$/
    if(!input.value.match(pricePattern) || input.value<=0){
        alert("Invalid input! Price cannot be negative or 0, max 2 decimal places allowed.");
        input.value=0.01;
    }
}
