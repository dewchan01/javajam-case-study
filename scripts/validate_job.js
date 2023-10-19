function validateName(input) {
    var value = input.value;
    var namePattern = /^[A-Za-z\s]+/;
    if (!value.match(namePattern)) {
        alert("Name must contain only alphabet characters and spaces.");
        input.value = '';
    }
}

function validateEmail(input) {
    var value = input.value;
    var emailPattern = /^[\w.-]+@(?:\w+\.){1,3}\w{2,3}$/;

    if (!value.match(emailPattern)) {
        if (!value.includes('@')) {
            alert("Email address must contain the '@' symbol.");
        } else if (value.split('@')[1].split('.').length < 2 || value.split('@')[1].split('.').length > 4) {
            alert("Invalid email address. It should have 2-4 address extensions (e.g., example@example.com).");
        } else {
            alert("Invalid email address. The last extension should end with 2-3 characters (e.g., example@example.com).");
        }
        input.value = '';
    }
}


function validateStartDate(input) {
    var value = input.value;
    var startDate = new Date(value);
    var today = new Date();

    if (startDate <= today) {
        alert("Start date must be in the future.");
        input.value = '';
    }
}
