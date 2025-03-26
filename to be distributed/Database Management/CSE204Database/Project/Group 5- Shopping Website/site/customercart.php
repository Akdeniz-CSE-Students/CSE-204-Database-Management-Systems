

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cart</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f1f1f1;
    }

    .box {
      width: 1270px;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-top: 25px;
      box-sizing: border-box;
    }


    /* Dropdown Button */
    .dropbtn {
      background-color: #3498DB;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    /* Dropdown button on hover & focus */
    .dropbtn:hover,
    .dropbtn:focus {
      background-color: #2980B9;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
      background-color: #ddd
    }

    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
    .show {
      display: block;
    }

    .right {
      float: right;
    }

  </style>


</head>

<body>
  <div class="container box">

  <div class="dropdown">
      <a href="signin.php"><button onclick="myFunction()" class="dropbtn">Log Out</button></a>
    </div>


    <div style="text-align: center;">
    <h1> <?php 
        session_start();
      
        echo "Welcome " .$_SESSION['fullname']."<br/><h4> Customer ID : ". $_SESSION['customerID']." </h4>";
        
       
    ?></h1>
    </div>

    <br/>
    <div class="table-responsive">
      <br />
      <div>
        <a href="productlist.php">  <button type="button" name="q1" id="q1" class="btn btn-info">Question 1</button> </a>
        <a href="price.php"><button type="button" name="q2" id="q2" class="btn btn-info">Question 2</button></a>
        <a href="main.php"> <button type="button" name="q34" id="q34" class="btn btn-info">Question 3-4</button></a>
        <a href="main2.php"> <button type="button" name="q5" id="q5" class="btn btn-info">Question 5</button></a>
        <form method="post" action="" class="center">
          <div class="right">
            
            <input type="submit" name="btn" value="Buy all" class="btn btn-danger"  >
            <h4><?php
            
            $conn = mysqli_connect("localhost", "root", "", "databaseproject");
            
            if (!$conn) {
              die("connion failed: " .mysqli_connect_error());
            }
            $CustomerId = $_SESSION['customerID'];

            $sql = "SELECT SUM(p.Price*pic.ProductCount)as total FROM productincart pic
            INNER JOIN product p ON p.ProductID=pic.ProductID
            WHERE pic.CartID=(SELECT crt.CartID FROM cart crt
            WHERE crt.CustomerID=$CustomerId)";

            $sonuc = mysqli_query($conn, $sql) or die("sql hatası");

            $row = mysqli_fetch_array($sonuc);

            $index = $row['total'];

            if ($_SESSION['PriceCurrency'] == "$")  
              echo "Total: " . $index . $_SESSION['PriceCurrency'];
            elseif($_SESSION['PriceCurrency'] == "€")
              echo "Total: " . $index * 0.82 . $_SESSION['PriceCurrency'];
            elseif($_SESSION['PriceCurrency'] == "₺")
              echo "Total: " . $index * 8.42 . $_SESSION['PriceCurrency'];


            

            ?></h4>
          </div>
        
        </form>
      </div>
      <br />
      <div id="alert_message"></div>
      <table id="user_data" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Product QR Code</th>
            <th>Product Name</th>
            <th>Product Brand</th>
            <th>Product Model</th>
            <th>Product Price</th>
            <th>Price Currency</th>
            <th>Product Color</th>
            <th>Product Count</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</body>

</html>

<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    fetch_data();

    function fetch_data() {
      var dataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "oncart.php",
          type: "POST"
        }
      });
    }
    $(document).on('click', '.remove', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this item from cart?" + id))
   {
    $.ajax({
     url:"removecart.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
      window.location.reload();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });

  $(document).on('click', '.update', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to delete 1 item from cart?"+id))
   {
    $.ajax({
     url:"update.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
      window.location.reload();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>


<?php 

$baglan = mysqli_connect("localhost", "root", "", "databaseproject");

        if (!$baglan) {
            die("connection failed : " . mysqli_connect_error());
        }
        
        $CustomerId = $_SESSION['customerID'];

      $sorgu = "SELECT COUNT(pc.ProductID) AS Count FROM productincart pc
      INNER JOIN cart c ON c.CartID=pc.CartID
      WHERE c.CustomerID='$CustomerId'";
      $sonuc = mysqli_query($baglan, $sorgu) or die("sql hatası");
      $rowsnc = mysqli_fetch_assoc($sonuc);
      
      $index=1;  
      if($_SESSION["PriceCurrency"]=="€")
          $index=0.82;
      elseif($_SESSION["PriceCurrency"]=="₺")
          $index=8.42;
        
    
      if (isset($_POST["btn"])) {
        if($rowsnc['Count'] != 0) {
          $sql = "INSERT INTO productorder (CustomerID,Date,TotalPrice,PriceCurrency,DeliveryTime,OrderAddress)
          SELECT c.CustomerID,CURRENT_DATE()as Date,SUM(p.Price)*$index as total,'".$_SESSION['PriceCurrency']."',10,ca.Address FROM customer c
          INNER JOIN cart crt ON crt.CustomerID=c.CustomerID
          INNER JOIN productincart pc ON pc.CartID=crt.CartID
          INNER JOIN product p ON p.ProductID=pc.ProductID
          INNER JOIN customeraddress ca ON ca.CustomerID=c.CustomerID
          WHERE ca.AddressName='HOME' AND c.CustomerID='$CustomerId'";
         
          $result = mysqli_query($baglan, $sql) or die("sql hatasi");

          $sql2 = "INSERT INTO productorderrelation (ProductID,OrderID,ProductCount)
          SELECT pc.ProductID,(SELECT MAX(po.OrderID) FROM productorder po),pc.ProductCount FROM productincart pc
          INNER JOIN cart cr ON cr.CartID=pc.CartID
          INNER JOIN customer c ON c.CustomerID=cr.CustomerID
          WHERE c.CustomerID='$CustomerId'";
          $result2 = mysqli_query($baglan, $sql2) or die("sql hatası");

          $sql3= "SELECT pc.ProductID,pc.ProductCount FROM productincart pc
          INNER JOIN cart cr ON cr.CartID=pc.CartID
          INNER JOIN product p ON p.ProductID=pc.ProductID
          INNER JOIN customer c ON c.CustomerID=cr.CustomerID
          WHERE c.CustomerID='$CustomerId'";

          $result3 = mysqli_query($baglan, $sql3) or die("sql hatası");

          while ($row = mysqli_fetch_assoc($result3)) {

            $sql4= "UPDATE product SET product.Quantity=product.Quantity-{$row['ProductCount']}
            WHERE product.ProductID= {$row['ProductID']}";
            $result4 = mysqli_query($baglan, $sql4) or die("sql hatası");
          }

          $sql5="DELETE FROM productincart
          WHERE productincart.CartID=(SELECT cart.CartID FROM cart WHERE cart.CustomerID='$CustomerId') ";
          $result5 = mysqli_query($baglan, $sql5) or die("sql hatası");
          echo "<script>window.location.reload();</script>";
        }
      }

?>
 