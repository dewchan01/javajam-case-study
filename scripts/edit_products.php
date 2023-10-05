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

for($i=0;$i<3;$i++)
{
    if(isset($_POST['edit'.$i]))
    {
        $editedSingle=$_POST['singleProduct'.$i];
        $editedDouble= ($i>0) ? $_POST['doubleProduct'.$i] : null;
        $editQuery = "UPDATE products SET singleProductPrice = ?,doubleProductPrice=? WHERE productId= ?";
        $stmt = $conn->prepare($editQuery);
        $stmt-> bind_param("ddi",$editedSingle,$editedDouble,$i);
        $stmt->execute();
        $stmt->close();
        header("Location: edit_products.php");
    }
}


$conn->close();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>JavaJam Coffee House</title>
    <link href="../style/javajam.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/calculate_price.js"></script>
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
        <h2>Click to update product prices:</h2>
        <table class = "menu" summary="The table has three rows and two columns. Each row describes a featured menu item.">
            <?php
            if($resultProducts->num_rows> 0){
                $count = 0;
                while($row= $resultProducts->fetch_assoc()){
                    if($count!==0){echo "</td></tr>";}
                    echo ($count%2===0) ? "<tr class='altrow'>" : "<tr>";
                    echo "<td><input type='checkbox' name='product".$count."' id ='product".$count."' ></td>";
                    echo "<th>". $row["productName"] ."</th>";
                    echo "<td>". $row["productDescription"]."<br/>";
                    echo $row["doubleProductPrice"] ? "<strong>Single ".number_format($row["singleProductPrice"], 2)." Double ".number_format($row["doubleProductPrice"], 2)."</strong><br>" : "<strong>Endless Cup ".number_format($row["singleProductPrice"], 2)."</strong><br>";
                    echo "<form id='textbox".$count."' ,action='edit_products.php' method ='POST' style='display: none;'>";
                    echo "<input type='number' min='0' step='0.01' name='singleProduct".$count."' value='".$row["singleProductPrice"]."'/>";
                    if($row["doubleProductPrice"])
                    {
                        echo "<input type='number' min='0' step='0.01' name='doubleProduct".$count."' value='".$row["doubleProductPrice"]."'/>";
                    }
                    echo "<button type='submit' name='edit".$count."'>Submit</button> ";
                    echo "</form></td></tr>";
                    $count++;
                }
            }
            ?>
        </table>
        <a href="../menu.php">Back</a>
        </div>
    </div>
        <div id="footer">Copyright &copy; 2014 JavaJam Coffeee House<br />
            <a href="mailto:dewei@chan.com">dewei@chan.com</a>
        </div>
    <script src="edit_products.js"></script>
</body>

</html>