<?php 
session_start();
$baglan = mysqli_connect("localhost", "root", "", "databaseproject");

if (!$baglan) {
    die("connection failed : " . mysqli_connect_error());
}
    $CustomerId = $_SESSION['customerID'];

    $sql = "UPDATE productincart pic SET ProductCount = pic.ProductCount - 1 WHERE pic.ProductID = '".$_POST["id"]."'";

    $result = mysqli_query($baglan,$sql) or die("sql hatası");

    

    $sql1 = "DELETE FROM productincart 
    WHERE productincart.ProductID='".$_POST["id"]."' AND productincart.CartID IN (SELECT cr.CartID FROM cart cr WHERE cr.CustomerID='$CustomerId') AND productincart.ProductCount = 0";

    $result2 = mysqli_query($baglan,$sql1) or die("sql hatası");


?>