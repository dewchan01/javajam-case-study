<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submitted Form Data</title>
</head>
<body>
    <h2>Submitted Form Data</h2>
    <p>Here are the details you submitted:</p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Access and display the submitted data
        echo "<strong>Name:</strong> " . htmlspecialchars($_POST['myName']) . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($_POST['myEmail']) . "<br>";
        
        // Check if Start Date is set and display it
        if(isset($_POST['startDate'])) {
            echo "<strong>Start Date:</strong> " . htmlspecialchars($_POST['startDate']) . "<br>";
        }

        echo "<strong>Experience:</strong><br>";
        echo nl2br(htmlspecialchars($_POST['myExperience'])) . "<br>";
    } else {
        echo "No data submitted.";
    }
    ?>

    <p><a href="javascript:history.go(-1)">Back to the form</a></p>
</body>
</html>
