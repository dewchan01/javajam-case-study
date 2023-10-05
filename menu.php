<?php

$servername = "localhost";
$username = "root";
$password = "";

$dbname = "jjdb";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Connection faild: " . $conn->connect_error);

}
$products = "SELECT * FROM products";
$resultProducts = $conn->query($products);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>JavaJam Coffee House</title>
    <link href="style/javajam.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/calculate_price.js"></script>
    <meta charset="utf-8">
</head>

<body>
    <header>
        <h1 id="logo"><img src="images/javalogo.gif" alt="JavaJam Coffee House" width="619" height="117" /></h1>
    </header>
    <div id="wrapper">
    <div id="nav">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="music.html">Music</a></li>
            <li><a href="jobs.html">Jobs</a></li>
        </ul>
    </div>
    <div id="content">
        <h2>Coffee at JavaJam</h2>
        <form method="post" action="scripts/process_order.php">
        <table class = "menu" summary="The table has three rows and two columns. Each row describes a featured menu item.">
        <?php
            if($resultProducts->num_rows> 0){
                $count = 0;
                while($row= $resultProducts->fetch_assoc()){
                    if($count!==0){echo "</td></tr>";}
                    echo ($count%2===0) ? "<tr class='altrow'>" : "<tr>";
                    echo "<th>". $row["productName"] ."</th>";
                    echo "<td>". $row["productDescription"]."<br/>";
                    if ($row["doubleProductPrice"]) {
                        echo "<input type='radio' name='" . $row["productName"] . "SinglePrice' id='" . $row["productName"] . "Price1' value='" . $row["singleProductPrice"] . "' onclick=\"setPrice('".$row["productName"]."Price1','".$row["productName"]."Qty','".$row["productName"]."Total')\" /><strong>Single ".number_format($row["singleProductPrice"], 2)."</strong>";
                        echo "<input type='radio' name='" . $row["productName"] . "DoublePrice' id='" . $row["productName"] . "Price2' value='" . $row["doubleProductPrice"] . "' onclick=\"setPrice('".$row["productName"]."Price2','".$row["productName"]."Qty','".$row["productName"]."Total')\"/><strong>Double ".number_format($row["doubleProductPrice"], 2)."</strong>";
                    } else {
                        echo "<input type='radio' name='" . $row["productName"] . "Price' id='" . $row["productName"] . "Price' value='" . $row["singleProductPrice"] . "' onclick=\"setPrice('".$row["productName"]."Price','".$row["productName"]."Qty','".$row["productName"]."Total')\"/><strong>Endless Cup ".number_format($row["singleProductPrice"], 2)."</strong>";
                    }
                    echo "<td>Quantity: <input type='number' name='".$row["productName"]."Qty' id='".$row["productName"]."Qty' min='0' value='0' placeholder='Enter the quantity' required onchange=\"calculateSubTotal('".$row["productName"]."Qty','".$row["productName"]."Total')\"/></td>";
                    echo "<td>Sub-Total: <input type='text' name='".$row["productName"]."Total' id='".$row["productName"]."Total' readonly value='0.00'/></td>";

                    $count++;
                }
            }
            
        ?>
            <tr>
                <th>
                    <a href="scripts/admin.php">Admin</a>
                </th>
                <td colspan="3" style="text-align:right">
                    Total Price:
                    <input type="number" name="totalPrice" id="totalPrice" readonly value="0.00"/>
                    <input type="submit" name="checkout" id="checkout" value="Checkout"/>
                </td> 
        </table>
        </form>
        </div>
    </div>
        <div id="footer">Copyright &copy; 2014 JavaJam Coffeee House<br />
            <a href="mailto:dewei@chan.com">dewei@chan.com</a>
        </div>

</body>

</html>