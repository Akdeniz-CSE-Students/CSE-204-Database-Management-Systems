
<?php
//fetch.php
session_start();
$connect = mysqli_connect("localhost", "root", "", "databaseproject");
$columns = array('first_name', 'last_name');
$CustomerId = $_SESSION['customerID'];

$query = "SELECT ct.CartID,p.ProductID,p.Name,pmb.ProductBrand,p.ProductModel,p.Price,p.PriceCurrency ,P.Color, pc.ProductCount FROM cart ct
  INNER JOIN customer c ON c.CustomerID=ct.CustomerID
  INNER JOIN productincart pc ON pc.CartID=ct.CartID
  INNER JOIN product p ON p.ProductID=pc.ProductID
  INNER JOIN productmodelbrand pmb ON pmb.ProductModel=p.ProductModel
  WHERE ct.CustomerID='$CustomerId'";


if(isset($_POST["search"]["value"]))
{
  $query = "SELECT ct.CartID,p.ProductID,p.Name,pmb.ProductBrand,p.ProductModel,p.Price,p.PriceCurrency ,P.Color, pc.ProductCount FROM cart ct
  INNER JOIN customer c ON c.CustomerID=ct.CustomerID
  INNER JOIN productincart pc ON pc.CartID=ct.CartID
  INNER JOIN product p ON p.ProductID=pc.ProductID
  INNER JOIN productmodelbrand pmb ON pmb.ProductModel=p.ProductModel
  WHERE ct.CustomerID='$CustomerId' AND (p.Name LIKE '%" . $_POST["search"]["value"]. "%' OR p.ProductID LIKE '%" . $_POST["search"]["value"]. "%' OR p.ProductModel LIKE '%" . $_POST["search"]["value"]. "%' OR pmb.ProductBrand LIKE '%" . $_POST["search"]["value"]. "%')";
}



$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
  $id = $row['ProductID'];

  $sub_array = array();
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="id">' . $row["ProductID"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="nic">' . $row["Name"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="nic">' . $row["ProductBrand"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="email">' . $row["ProductModel"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="email">' . $_SESSION["Price".$id] * $row["ProductCount"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="first_name">' . $_SESSION["PriceCurrency"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="last_name">' . $row["Color"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ProductID"].'" data-column="last_name">' . $row["ProductCount"] . '</div>';
  $sub_array[] = '<button type="button" name="remove" class="btn btn-danger btn-xs remove" id="'.$row["ProductID"].'">Remove All</button> <button type="button" name="update" class="btn btn-warning btn-xs update" id="'.$row["ProductID"].'">Remove</button>';

 $data[] = $sub_array;
}

function get_all_data($connect)
{
$CustomerId = $_SESSION['customerID'];
$query = "SELECT ct.CartID,p.ProductID,p.Name,pmb.ProductBrand,p.ProductModel,p.Price,p.PriceCurrency ,P.Color, pc.ProductCount FROM cart ct
INNER JOIN customer c ON c.CustomerID=ct.CustomerID
INNER JOIN productincart pc ON pc.CartID=ct.CartID
INNER JOIN product p ON p.ProductID=pc.ProductID
INNER JOIN productmodelbrand pmb ON pmb.ProductModel=p.ProductModel
WHERE ct.CustomerID='$CustomerId'";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>