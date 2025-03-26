<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Price Statistics</title>
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
            </div>
            <br />
            <div id="alert_message"></div>
            <table id="user_data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product Type</th>
                        <th>MAX</th>
                        <th>AVERAGE</th>
                        <th>MIN</th>
                        <th>Currency</th>
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
          url: "okan.php",
          type: "POST"
        }
      });
    }
 });
</script>