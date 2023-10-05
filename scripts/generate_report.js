function generateReport(reportType) {
    if (reportType === 'byProducts') {
        document.getElementById("reportResultByProducts").style.display = "block";
        document.getElementById("reportResultByCategories").style.display = "none";
    } else if (reportType === 'byCategories') {
        document.getElementById("reportResultByProducts").style.display = "none";
        document.getElementById("reportResultByCategories").style.display = "block";
    }
}
