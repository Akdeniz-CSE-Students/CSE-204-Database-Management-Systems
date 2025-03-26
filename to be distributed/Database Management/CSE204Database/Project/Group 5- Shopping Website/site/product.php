<?php
session_start();

$connectect = mysqli_connect("localhost", "root", "", "databaseproject");

$columns = array('first_name', 'last_name');

$query = "SELECT p.ProductID, p.Name, pmb.ProductBrand, p.ProductModel, p.Color,p.Price, p.PriceCurrency, p.Quantity FROM product p 
INNER JOIN productmodelbrand pmb ON pmb.ProductModel= p.ProductModel
WHERE p.Quantity > 0";

if(isset($_POST["search"]["value"]))
{
  $query = "SELECT p.ProductID, p.Name, pmb.ProductBrand, p.ProductModel, p.Color,p.Price, p.PriceCurrency, p.Quantity FROM product p 
  INNER JOIN productmodelbrand pmb ON pmb.ProductModel= p.ProductModel
  WHERE p.Quantity > 0 AND (p.Name LIKE '%" . $_POST["search"]["value"]. "%' OR pmb.ProductBrand LIKE '%" . $_POST["search"]["value"]. "%' OR p.ProductID LIKE '" . $_POST["search"]["value"]. "%' )";
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
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="id">' . $row["ProductID"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="nic">' . $row["Name"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="nic">' . $row["ProductBrand"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="email">' . $row["ProductModel"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="email">' . $row["Color"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="first_name">' . $_SESSION["Price".$id] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="last_name">' . $_SESSION["PriceCurrency"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="home_address">' . $row["Quantity"] . '</div>';
  
 $sub_array[] = '<button type="button" name="buy" class="btn btn-success btn-xs buy" id="'.$row["ProductID"].'">BUY</button> <button type="button" name="cart" class="btn btn-warning btn-xs cart" id="'.$row["ProductID"].'">Add to Cart</button>';



 $data[] = $sub_array;

 
}

function get_all_data($connectect)
{
 $query = "SELECT p.ProductID, p.Name, pmb.ProductBrand, p.ProductModel, p.Color,p.Price, p.PriceCurrency, p.Quantity FROM product p 
 INNER JOIN productmodelbrand pmb ON pmb.ProductModel= p.ProductModel
 WHERE p.Quantity > 0"  ;
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