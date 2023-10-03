<?php

    if(isset($_POST['adminPassword']))
    {
        $password=$_POST['adminPassword'];
        if($password==="admin123")
        {
            header("Location:edit_products.php");
        }
        else
        {
            echo "<script>alert('Wrong Password!')</script>";
        }
    }

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
        <h2>Admin Login Page</h2>
        <p>Please Enter Admin Password</p>
        <form method="post" action="admin.php" onsubmit="proceed()">
            <div class="myRow">
                <input type="password" name="adminPassword" id="adminPassword" required>
            </div>
            <div class="mySubmit">
                <input type="submit" value="Submit" />
            </div>
        </form>
        </div>
        </div>
        <div id="footer">Copyright &copy; 2014 JavaJam Coffeee House<br />
            <a href="mailto:dewei@chan.com">dewei@chan.com</a>
        </div>
    </div>
</body>

</html>
