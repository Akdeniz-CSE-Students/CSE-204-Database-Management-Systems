

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping</title>
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
    <div class="right">


        <form action="main.php" method="get">
            <select name="dropdownn">
                <option value="" disabled selected>Select Currency</option>
                <option value="usd" >Dollar</option>
                <option value="eur" >Euro</option>
                <option value="tl" >Turkish Liras</option>
            </select>

            <input type="submit" name="sbmt" value="Convert"/>
        </form>
    </div>
    
    <?php
      session_start();
      $conn = mysqli_connect("localhost", "root", "", "databaseproject");
      
      if (!$conn) {
        die("connion failed: " .mysqli_connect_error());
      }

      $sql = "SELECT * FROM product WHERE product.Quantity > 0";
      $sonuc = mysqli_query($conn, $sql) or die("sql hatası");

      
      while($row = mysqli_fetch_array($sonuc)) {
        $id = $row["ProductID"]; 
    
        if (isset($_GET['sbmt'])) {
          
          $amb = $row['PriceCurrency'];
          $id = $row['ProductID'];
          $cur = $row['Price'];
          $_SESSION['PriceCurrency'] = '$';
          $_SESSION['PriceCurrency'] = '€';
          $_SESSION['PriceCurrency'] = '₺';
          
          $sql2 = "SELECT ProductID from product where product.Quantity > 0";
        
        
          
              $cc_dropdown = $_GET['dropdownn'];
              if ($amb == '$') {
                  if ($cc_dropdown == 'usd') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 1;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '$';
                    }
                      
                      
                  }elseif ($cc_dropdown == 'eur') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 0.82;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '€';
                      
                    }
                      
                  }elseif ($cc_dropdown == 'tl') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 8.42;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '₺';
                    }
                      
                      
                  }
                                  
              }elseif ($amb == '€') {
                
                  if ($cc_dropdown == 'usd') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 1.22;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '$';
                    }
                      
                      
                  }elseif ($cc_dropdown == 'eur') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 1;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '€';
                    }
                      
                      
                  }elseif ($cc_dropdown == 'tl') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 10.25;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '₺';
                    }
                      
                      
                  }
                  
              }elseif ($amb == '₺') {
                  if ($cc_dropdown == 'usd') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 0.12;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '$';
                    }
                     
                      
                      
                  }elseif ($cc_dropdown == 'eur') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 0.098;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '€';
        
                    }
                      
                  }elseif ($cc_dropdown == 'tl') {
                    if (mysqli_query($conn, $sql2)) {
                      $cur = $cur * 1;
                      $_SESSION["Price".$id] = $cur;
                      $_SESSION['PriceCurrency'] = '₺';
                    }
                      
                      
                  }
                  
              }
          }
          
      }

    ?>

    <div style="text-align: center;">
    <h1> <?php 
        
      
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
        <a href="customercart.php"> <button type="button" name="cart" id="cart" class="btn btn-info">Cart</button></a>
      </div>
      <br />
      <div id="alert_message"></div>
      <table id="user_data" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Product QR Code</th>
            <th>Name</th>
            <th>Product Brand</th>
            <th>Product Model</th>
            <th>Color</th>
            <th>Price</th>
            <th>PriceCurrency</th>
            <th>Quantity</th>
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
          url: "product.php",
          type: "POST"
        }
      });
    }


    $(document).on('click', '.buy', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to buy this?" + id ))
   {
    $.ajax({
     url:"buy.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });


  $(document).on('click', '.cart', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to add to cart this item?"))
   {
    $.ajax({
     url:"cart.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>