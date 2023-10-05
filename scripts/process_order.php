<?php
$servername = "localhost";
$username = "root";
$password = "";

$dbname = "jjdb";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {

        // Check if the key contains "Qty" to identify quantity fields
        if (strpos($key, "Qty") !== false) {
            // Extract the product name from the key
            $productName = str_replace("Qty", "", $key);
            $quantity = $value;
    
            // Determine the category ("single" or "double") from the $key
            $category = '';
            $price = 0;
    
            // Construct the price key dynamically    
            if (isset($_POST[$productName . 'SinglePrice'])) {
                $priceKey = $productName . 'SinglePrice';
                $category = 'Single';
            } else if (isset($_POST[$productName . 'DoublePrice'])){
                $priceKey = $productName . 'DoublePrice';
                $category = 'Double';
            }else{
                $priceKey = $productName . 'Price';
                $category = 'Endless Cup';
            }

            if(isset($_POST[$priceKey])){
            $totalPrice = number_format($_POST[$priceKey] * $quantity, 2);
            }

            if ($quantity > 0) {
                $insertOrder = "INSERT INTO orders (time, productName, category, quantity, price )
                                VALUES (CURRENT_TIMESTAMP, '$productName', '$category', '$quantity', '$totalPrice' )";
    
                if ($conn->query($insertOrder) === TRUE) {
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        }
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>JavaJam Coffee House</title>
    <link href="../style/javajam.css" rel="stylesheet" type="text/css" />

    <meta charset="utf-8">
</head>

<body>
    <header>
        <h1 id="logo"><img src="../images/javalogo.gif" alt="JavaJam Coffee House" width="619" height="117" /></h1>
    </header>
    <div id="wrapper">
    <div id="nav">
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="../menu.php">Menu</a></li>
            <li><a href="../music.html">Music</a></li>
            <li><a href="../jobs.html">Jobs</a></li>
        </ul>
    </div>
    <div id="content" style='text-align:center'>
        <h2>Order placed successfully!</h2>
        <a href='../menu.php'>Back to Menu</a>
        </div>
        </div>

        <div id="footer">Copyright &copy; 2014 JavaJam Coffeee House<br />
            <a href="mailto:dewei@chan.com">dewei@chan.com</a>
        </div>
</body>

</html>
