<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jjdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dateInput = new DateTime(); 

if (!empty($_POST["date"])) {
    $dateInput = new DateTime($_POST["date"]);
    
}

$dateInput = $dateInput->format('Y-m-d');

$productsql = "SELECT
    DATE(time) AS day,
    productName,
    SUM(quantity) AS totalQuantity,
    SUM(CAST(price AS DECIMAL(10,2))) AS totalPrice
FROM
    orders
WHERE
    DATE(time) = '$dateInput'
GROUP BY
    day, productName";


$categorysql = "SELECT
    DATE(time) AS day,
    category,
    SUM(quantity) AS totalQuantity,
    SUM(CAST(price AS DECIMAL(10,2))) AS totalPrice
FROM
    orders
WHERE
    DATE(time) = '$dateInput'
GROUP BY
    day, category";

$bestsellsql = "SELECT category, SUM(quantity) AS totalQuantity, productName
FROM orders
WHERE productName = (
    SELECT productName
    FROM (
        SELECT productName, SUM(CAST(price AS DECIMAL(10,2))) AS totalPrice
        FROM orders
        GROUP BY productName
        ORDER BY totalPrice DESC
        LIMIT 1
    ) AS highest_price_product
) AND DATE(time) = '$dateInput'
GROUP BY category
ORDER BY 
    totalQuantity DESC,category = 'Double' DESC
LIMIT 1;
";


$productresult = $conn->query($productsql);
$categoryresult = $conn->query($categorysql);
$bestsellresult = $conn->query($bestsellsql);

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
                <li><a href="edit_products.php">Product <br> Prices <br> Update</a></li>
                <br>
                <li><a href="report.php">Daily <br> Sales <br> Report</a></li>
            </ul>
        </div>
        <div id="content">
            <h3>Click to generate daily sales report:</h3>
            <form action="report.php" method="post" id = "reportForm">
            <label class="labelCol" for="date">Date:</label>
            <input type="date" name="date" id="date" onchange="submitForm(this)" value = "<?php echo isset($_POST["date"]) ? $_POST["date"] : date('Y-m-d'); ?>">
            </form>
            <table class = "menu" summary="The table has three rows and two columns. Each row describes a featured menu item.">
            <tr>
                <td><input type='radio' name='reportType' id='byProducts' value='byProducts' onclick=generateReport(this.value)></td>
                <td>Total dollar and quantity sales by products</td>
            </tr>
            <tr>
                <td><input type='radio' name='reportType' id='byCategories' value='byCategories' onclick=generateReport(this.value)></td>
                <td>Total dollar and quantity sales by categories</td>
            </tr>
            </table>
            <div id="reportResultByProducts" style="display:None">
                <?php
                    if ($productresult->num_rows > 0) {
                        echo "<table>";
                        echo "<tr class='altrow'><th>Date</th><th>Product Name</th><th>Total Price</th><th>Total Quantity</th></tr>";

                        while ($row = $productresult->fetch_assoc()) {
                            echo "<tr style='background-color:#E2D2B0'>";
                            echo "<td>" . $row["day"] . "</td>";
                            echo "<td>" . $row["productName"] . "</td>";
                            echo "<td>$" . number_format($row["totalPrice"], 2) . "</td>";
                            echo "<td>" . $row["totalQuantity"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No results found.";
                    }
                ?>
            </div>

        <div id="reportResultByCategories" style="display:None">
            <?php
            if ($categoryresult->num_rows > 0) {
                echo "<table>";
                echo "<tr class='altrow'><th>Date</th><th>Category</th><th>Total Price</th><th>Total Quantity</th></tr>";

                while ($row = $categoryresult->fetch_assoc()) {
                    echo "<tr style='background-color:#E2D2B0'>";
                    echo "<td>" . $row["day"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>$" . number_format($row["totalPrice"], 2) . "</td>";
                    echo "<td>" . $row["totalQuantity"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No results found.";
            }   
            ?>
    </div>
    <h3>Popular option of best selling product: 
        <?php
            if ($bestsellresult->num_rows > 0) {
                while ($row = $bestsellresult->fetch_assoc()) {
                    echo $row["category"] !=='Endless Cup' ? $row["productName"] . " (" . $row["category"] . ")" :  $row["productName"] . " (Null)";

                }
            } else {
                echo "No results found.";
            }  

        ?>    
    </h3>
        <a href="../menu.php" >Back</a>
    </div>
    </div>
        <div id="footer">Copyright &copy; 2014 JavaJam Coffeee House<br />
            <a href="mailto:dewei@chan.com">dewei@chan.com</a>
        </div>
    <script src="generate_report.js"></script>
</body>

</html>