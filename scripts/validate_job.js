function validateForm() {
    var name = document.getElementById("myName").value;
    var email = document.getElementById("myEmail").value;
    var startDate = new Date(document.getElementById("startDate").value);
    // Validate name field
    var namePattern = /^[A-Za-z\s]+$/;

    if (!name.match(namePattern)) {
        alert("Name must contain only alphabet characters and spaces.");
        return false;
    }

    // Regular expression pattern for email validation
    var emailPattern = /^[\w.-]+@(?:\w+\.){1,3}\w{2,3}$/;

    if (!email.match(emailPattern)) {
        alert("Invalid email address. Please enter a valid email address.");
        return false;
    }

    var today = new Date();

    // Compare the selected start date with today's date
    if (startDate <= today) {
        alert("Start date must be in the future.");
        return false;
    }

    // If all validations pass, the form will be submitted
    return true;
}