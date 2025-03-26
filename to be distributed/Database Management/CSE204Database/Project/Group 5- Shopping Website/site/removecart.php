<?php 
session_start();
$baglan = mysqli_connect("localhost", "root", "", "databaseproject");

if (!$baglan) {
    die("connection failed : " . mysqli_connect_error());
}
    $CustomerId = $_SESSION['customerID'];


    $sql = "DELETE FROM productincart 
    WHERE productincart.ProductID='".$_POST["id"]."' AND productincart.CartID IN (SELECT cr.CartID FROM cart cr WHERE cr.CustomerID='$CustomerId')";

    $result = mysqli_query($baglan,$sql) or die("sql hatası");


    header("Refresh:0");
    


?>