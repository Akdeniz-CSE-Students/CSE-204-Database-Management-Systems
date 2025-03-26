<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 570px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 350px;
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

</head>

<body>
    <div class="container box">

    <h1 style="text-align: center;">WELCOME</h1>
    <form method="post" action="" style="text-align: center; margin-top: 50px;">


<input type="text" name="email" style=" margin-bottom: 10px;" placeholder="Enter E-mail">
</br>
<input type="text" name="password" style=" margin-bottom: 10px;" placeholder="Enter Password">

</br>
<input type="submit" name="buton" value="Log In">

</form>

<?php

session_start();

$baglan = mysqli_connect("localhost", "root", "", "databaseproject");

if (!$baglan) {
die("connection failed : " . mysqli_connect_error());
}


if (!empty($_POST["email"]) && !empty($_POST["password"])) {
$emailx = trim($_POST["email"]);
$passwordx = trim($_POST["password"]);

$sql = "SELECT customer.CustomerID, CONCAT(customer.FirstName,' ' ,customer.Surname) AS fullname FROM customer WHERE customer.Email = '$emailx' AND customer.Password = '$passwordx'";

$result = mysqli_query($baglan, $sql) or die("sql hatası");
}

if (isset($_POST["buton"])) {
if (empty($emailx) || empty($passwordx)) {
    echo "BOŞ BIRAKALAMAZ";
} else if (mysqli_num_rows($result) == 1) {
    echo "başarılı";
    $row = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $emailx;

    $customerID = "{$row['CustomerID']}";
    $_SESSION['customerID'] = $customerID;

    $customerfullname = "{$row['fullname']}";
    $_SESSION['fullname'] = $customerfullname;

    header("location: productlist.php");
    die;
} else {
    echo "başarızız";
}
}

?>
    </div>
    

</body>

</html>