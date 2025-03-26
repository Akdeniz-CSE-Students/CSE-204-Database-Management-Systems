<?php
session_start();
$baglan = mysqli_connect("localhost", "root", "", "databaseproject");

if (!$baglan) {
    die("connection failed : " . mysqli_connect_error());
}
$CustomerId = $_SESSION['customerID'];


    $sql = "DELETE FROM productcomment 
    WHERE productcomment.CommentID='".$_POST["id"]."'";

    $result = mysqli_query($baglan,$sql) or die("sql hatası");

    echo "BAŞARIYLA SİLİNDİ" ;

?>