<?php
session_start();
$baglan = mysqli_connect("localhost", "root", "", "databaseproject");

if (!$baglan) {
    die("connection failed : " . mysqli_connect_error());
}
$CustomerId = $_SESSION['customerID'];


if(isset($_POST["id"]))
{
 $qq = "SELECT product.Price FROM product WHERE product.ProductID = '".$_POST["id"]."'";

 $sonuc = mysqli_query($baglan, $qq) or die("sql hatası");
 $row = mysqli_fetch_assoc($sonuc);
 $qq1 = "SELECT MAX(productorder.OrderID) + 1 AS 'OrderID' FROM productorder";

 $adressQuery = "SELECT ca.Address FROM customeraddress ca
 WHERE ca.CustomerID='$CustomerId' and ca.AddressName='HOME'";
 $sncAdress = mysqli_query($baglan, $adressQuery) or die("sql hatası");

 $rowAddress = mysqli_fetch_assoc($sncAdress);

 $sonuc2 = mysqli_query($baglan, $qq1) or die("sql hatası");
 $row2= mysqli_fetch_assoc($sonuc2);
 $currency=$_SESSION['PriceCurrency'];
 if($_SESSION['PriceCurrency']=="$"){
 $sql = "INSERT INTO productorder(OrderID,CustomerID ,Date,TotalPrice,PriceCurrency,DeliveryTime,OrderAddress) VALUES('{$row2['OrderID']}','$CustomerId','2021-05-22', '{$row['Price']}','$currency',2,'{$rowAddress['Address']}')";
}elseif($_SESSION['PriceCurrency']=="€")   
 $sql = "INSERT INTO productorder(OrderID,CustomerID ,Date,TotalPrice,PriceCurrency,DeliveryTime,OrderAddress) VALUES('{$row2['OrderID']}','$CustomerId','2021-05-22', '{$row['Price']}'*0.82,'$currency',2,'{$rowAddress['Address']}')";
 elseif($_SESSION['PriceCurrency']=="₺")
 $sql = "INSERT INTO productorder(OrderID,CustomerID ,Date,TotalPrice,PriceCurrency,DeliveryTime,OrderAddress) VALUES('{$row2['OrderID']}','$CustomerId','2021-05-22', '{$row['Price']}'*8.42,'$currency',2,'{$rowAddress['Address']}')";
  
 $sql2 = "INSERT INTO productorderrelation(ProductID,OrderID,ProductCount) VALUES('".$_POST["id"]."','{$row2['OrderID']}',1)";
  $qq4="UPDATE product SET product.Quantity = (SELECT product.Quantity-1 FROM product WHERE product.ProductID = '".$_POST["id"]."') WHERE product.ProductID = '".$_POST["id"]."'";
  $sonuc3 = mysqli_query($baglan, $qq4) or die("sql hatası");
  

 if(mysqli_query($baglan, $sql) && mysqli_query($baglan,$sql2) )
 {
    echo "başarılı";
 }else{
     echo "başaramadık ab";
 }
}
?>