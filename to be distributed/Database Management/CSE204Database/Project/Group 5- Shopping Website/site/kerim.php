
<?php
session_start();

$connectect = mysqli_connect("localhost", "root", "", "databaseproject");

$columns = array('first_name', 'last_name');

$query = "SELECT c.FirstName,c.Surname,c.DOB,c.Gender,c.Email,ca.Address,c.PhoneNumber,por.ProductID,p.Name FROM customer c
      INNER JOIN productorder po ON po.CustomerID=c.CustomerID
      INNER JOIN productorderrelation por ON por.OrderID=po.OrderID
      INNER JOIN product p ON p.ProductID=por.ProductID
      INNER JOIN customeraddress ca ON ca.CustomerID=c.CustomerID
      WHERE ca.AddressName='HOME'";

if(isset($_POST["search"]["value"]))
{
    $query = "SELECT c.FirstName,c.Surname,c.DOB,c.Gender,c.Email,ca.Address,c.PhoneNumber,por.ProductID,p.Name FROM customer c
      INNER JOIN productorder po ON po.CustomerID=c.CustomerID
      INNER JOIN productorderrelation por ON por.OrderID=po.OrderID
      INNER JOIN product p ON p.ProductID=por.ProductID
      INNER JOIN customeraddress ca ON ca.CustomerID=c.CustomerID
      WHERE ca.AddressName='HOME'  AND (p.Name LIKE '%" . $_POST["search"]["value"]. "%' OR p.ProductID LIKE '". $_POST["search"]["value"]. "%')";
}


$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connectect, $query));




$result = mysqli_query($connectect, $query . $query1);
$data = array();



while($row = mysqli_fetch_array($result))
{

  $id = $row['ProductID'];


  $sub_array = array();
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="id">' . $row["FirstName"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="nic">' . $row["Surname"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="email">' . $row["DOB"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="email">' . $row["Gender"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="first_name">' .$row["Email"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="first_name">' .$row["Address"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="last_name">' . $row["PhoneNumber"]. '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="home_address">' . $row["ProductID"]. '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="home_address">' . $row["Name"]. '</div>';

 $data[] = $sub_array;

 
}

function get_all_data($connectect)
{
 $query = "SELECT c.FirstName,c.Surname,c.DOB,c.Gender,c.Email,ca.Address,c.PhoneNumber,por.ProductID,p.Name FROM customer c
    INNER JOIN productorder po ON po.CustomerID=c.CustomerID
    INNER JOIN productorderrelation por ON por.OrderID=po.OrderID
    INNER JOIN product p ON p.ProductID=por.ProductID
    INNER JOIN customeraddress ca ON ca.CustomerID=c.CustomerID
    WHERE ca.AddressName='HOME'  AND (p.Name LIKE '%" . $_POST["search"]["value"]. "%' OR p.ProductID LIKE '%". $_POST["search"]["value"]. "%')";
 $result = mysqli_query($connectect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connectect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>