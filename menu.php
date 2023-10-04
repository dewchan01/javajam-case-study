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

$conn->close();



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
        <table class = "menu" summary="The table has three rows and two columns. Each row describes a featured menu item.">
        <?php
            if($resultProducts->num_rows> 0){
                $count = 0;
                while($row= $resultProducts->fetch_assoc()){
                    if($count!==0){echo "</td></tr>";}
                    echo ($count%2===0) ? "<tr class='altrow'>" : "<tr>";
                    echo "<th>". $row["productName"] ."</th>";
                    echo "<td>". $row["productDescription"]."<br/>";
                    if($row["doubleProductPrice"])
                    {
                        echo "<input type='radio' name='".$row["productName"]."Price' id='".$row["productName"]."Price1' value='".$row["singleProductPrice"]."' onclick=\"setPrice('".$row["productName"]."Price1','".$row["productName"]."Qty','".$row["productName"]."Total')\" /><strong>Single ".number_format($row["singleProductPrice"], 2)."</strong>";
                        echo "<input type='radio' name='".$row["productName"]."Price' id='".$row["productName"]."Price2' value='".$row["doubleProductPrice"]."' onclick=\"setPrice('".$row["productName"]."Price2','".$row["productName"]."Qty','".$row["productName"]."Total')\"/><strong>Double ".number_format($row["doubleProductPrice"], 2)."</strong></td>";
                    }
                    else
                    {
                        echo "<input type='radio' name='".$row["productName"]."Price' id='".$row["productName"]."Price' value='".$row["singleProductPrice"]."' onclick=\"setPrice('".$row["productName"]."Price','".$row["productName"]."Qty','".$row["productName"]."Total')\"/><strong>Endless Cup ".number_format($row["singleProductPrice"], 2)."</strong></td>";
                    }
                    echo "<td>Quantity: <input type='number' name='".$row["productName"]."Qty' id='".$row["productName"]."Qty' min='0' value='0' placeholder='Enter the quantity' required onchange=\"calculateSubTotal('".$row["productName"]."Qty','".$row["productName"]."Total')\"/></td>";
                    echo "<td>Sub-Total: <input type='text' name='".$row["productName"]."Total' id='".$row["productName"]."Total' readonly value='0.00'/></td>";
                    $count++;
                }
            }
        ?>
            <!-- <tr class="altrow">##CaseStudy3 without php
                <th>Just Java</th>
                <td>Regular house blend, decaffeinated coffee, or flavor of the day.<br />
                    <input type="radio" name="justJavaPrice" id="justJavaPrice" value="2.00" onclick="setPrice('justJavaPrice','justJavaQty','justJavaTotal')"/> <strong>Endless Cup $2.00</strong>
                </td>
                <td>
                    Quantity: <input type="number" name="justJavaQty" id="justJavaQty" min="0" value="0" placeholder="Enter the quantity" required onchange="calculateSubTotal('justJavaQty','justJavaTotal')"/>
                </td>
                <td>
                    Sub-Total: <input type="text" name="justJavaTotal" id="justJavaTotal" readonly value="0.00"/>
                </td>
            </tr>
            <tr>
                <th>Cafe au Lait</th>
                <td>House blended coffee infused into a smooth, steamed milk.<br />
                    <input type="radio" name="cafePrice" id="cafePrice1" value="2.00" onclick="setPrice('cafePrice1','cafeQty','cafeTotal')"/><strong>Single $2.00</strong>
                    <input type="radio" name="cafePrice" id="cafePrice2" value="4.00" onclick="setPrice('cafePrice2','cafeQty','cafeTotal')"/><strong>Double $4.00</strong>
                </td>
                <td>
                    Quantity: <input type="number" name="cafeQty" id="cafeQty" min="0" value="0" placeholder="Enter the quantity" required onchange="calculateSubTotal('cafeQty','cafeTotal')"/>
                </td>
                <td>
                    Sub-Total: <input type="text" name="cafeTotal" id="cafeTotal" readonly value="0.00"/>
                </td>
            </tr>
            <tr class="altrow">
                <th>Iced Cappuccino</th>
                <td>Sweetened espresso blended with icy-cold milk and served in a chilled glass.
                    <input type="radio" name="cappPrice" id="cappPrice1" value="4.75" onclick="setPrice('cappPrice1','cappQty','cappTotal')"/><strong>Single $4.75</strong>
                    <input type="radio" name="cappPrice" id="cappPrice2" value="5.75" onclick="setPrice('cappPrice2','cappQty','cappTotal')"/><strong>Double $5.75</strong>
                </td>
                <td>
                    Quantity: <input type="number" name="cappQty" id="cappQty" min="0" value="0" placeholder="Enter the quantity" required onchange="calculateSubTotal('cappQty','cappTotal')"/>
                </td>
                <td>
                    Sub-Total: <input type="text" name="cappTotal" id="cappTotal" readonly value="0.00"/>
                </td>
            </tr>-->
            <tr>
                <th>
                    <a href="scripts/admin.php">Admin</a>
                </th>
                <td colspan="2" style="text-align: right;">
                    Total Price:
                </td>
                <td colspan="2">
                    <input type="number" name="totalPrice" id="totalPrice" readonly value="0.00"/>
                </td> 
        </table>
        </div>
    </div>
        <div id="footer">Copyright &copy; 2014 JavaJam Coffeee House<br />
            <a href="mailto:dewei@chan.com">dewei@chan.com</a>
        </div>

</body>

</html>