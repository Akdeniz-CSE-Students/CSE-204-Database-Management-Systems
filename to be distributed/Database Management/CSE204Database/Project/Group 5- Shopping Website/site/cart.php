<?php 

session_start();
$baglan = mysqli_connect("localhost", "root", "", "databaseproject");

if (!$baglan) {
    die("connection failed : " . mysqli_connect_error());
}
$CustomerId = $_SESSION['customerID'];
$sql="SELECT COUNT(cart.CustomerID) as cartCount FROM cart 
WHERE cart.CustomerID='$CustomerId'";

$result = mysqli_query($baglan, $sql) or die("sql hatası");
$row2 = mysqli_fetch_assoc($result);


if($row2['cartCount'] == 0) {
    $query1 = "INSERT INTO cart (CustomerID) VALUES ('$CustomerId')";
    $result = mysqli_query($baglan, $query1) or die("sql hatası");
    echo "cart eklendi";
}

$query2 = "SELECT cart.CartID FROM cart WHERE cart.CustomerID='$CustomerId'";
$result = mysqli_query($baglan, $query2) or die("sql hatası");
$row = mysqli_fetch_assoc($result);
$cartID = $row['CartID'];

$query3 = "SELECT COUNT(*) as countCol FROM productincart pc WHERE pc.ProductID='".$_POST["id"]."' AND pc.CartID='$cartID'";
$result3 = mysqli_query($baglan, $query3) or die("sql hatası");
$row3 = mysqli_fetch_assoc($result3);
$countCol = $row3['countCol'];

if($countCol == 1) {
    $query4 = "UPDATE productincart pc SET pc.ProductCount=pc.ProductCount+1 WHERE pc.ProductID='".$_POST["id"]."' AND pc.CartID='$cartID'";
    $result = mysqli_query($baglan, $query4) or die("sql hatası");
    echo "update edildi";
}else {
    $query5 = "INSERT INTO productincart (ProductID,CartID,ProductCount) VALUES ('".$_POST["id"]."','$cartID',1)";
    $result = mysqli_query($baglan, $query5) or die("sql hatası");
    echo "ürün eklendi";
}

?>