function generateReport(reportType) {
    if (reportType === 'byProducts') {
        document.getElementById("reportResultByProducts").style.display = "block";
        document.getElementById("reportResultByCategories").style.display = "none";
    } else if (reportType === 'byCategories') {
        document.getElementById("reportResultByProducts").style.display = "none";
        document.getElementById("reportResultByCategories").style.display = "block";
    }
}
function submitForm(input) {
    var value = input.value;
    var startDate = new Date(value);
    var today = new Date();

    if (startDate >= today) {
        alert("Selected date must be in the past or today.");
    }

document.getElementById("reportForm").submit();
}