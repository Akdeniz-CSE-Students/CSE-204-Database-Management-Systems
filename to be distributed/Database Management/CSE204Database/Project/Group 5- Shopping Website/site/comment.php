
<?php
//fetch.php
session_start();
$connect = mysqli_connect("localhost", "root", "", "databaseproject");
$columns = array('first_name', 'last_name');
$CustomerId = $_SESSION['customerID'];

$query = "SELECT p.ProductID,p.Name as 'Product Name',pc.CommentID,pc.Comment,pc.CommentStarCount,CONCAT(c.FirstName,' ',c.Surname)as 'Customer Full Name' FROM productcomment pc
  INNER JOIN product p ON p.ProductID=pc.ProductID
  INNER JOIN customer c ON c.CustomerID=pc.CustomerID
  WHERE pc.CustomerID='$CustomerId'";

if(isset($_POST["search"]["value"]))
{
  $query = "SELECT p.ProductID,p.Name as 'Product Name',pmb.ProductBrand,p.ProductModel,pc.CommentID,pc.Comment,pc.CommentStarCount,CONCAT(c.FirstName,' ',c.Surname)as 'Customer Full Name' FROM productcomment pc
  INNER JOIN product p ON p.ProductID=pc.ProductID
  INNER JOIN customer c ON c.CustomerID=pc.CustomerID
  INNER JOIN productmodelbrand pmb ON pmb.ProductModel=p.ProductModel
  WHERE pc.CustomerID='$CustomerId' AND (p.Name LIKE '%" . $_POST["search"]["value"]. "%' OR p.ProductModel LIKE '%" . $_POST["search"]["value"]. "%' OR pmb.ProductBrand LIKE '%" . $_POST["search"]["value"]. "%')";
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
  $sub_array = array();
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="id">' . $row["ProductID"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="id">' . $row["Product Name"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="id">' . $row["ProductBrand"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="id">' . $row["ProductModel"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="nic">' . $row["CommentID"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="nic">' . $row["Comment"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="email">' . $row["CommentStarCount"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CommentID"].'" data-column="email">' . $row["Customer Full Name"] . '</div>';
  
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["CommentID"].'">Delete Comment</button>';

 $data[] = $sub_array;
}

function get_all_data($connect)
{
  $CustomerId = $_SESSION['customerID'];
  $query = "SELECT p.ProductID,p.Name as 'Product Name',pc.Comment,pc.CommentStarCount,CONCAT(c.FirstName,' ',c.Surname)as 'Customer Full Name' FROM productcomment pc
  INNER JOIN product p ON p.ProductID=pc.ProductID
  INNER JOIN customer c ON c.CustomerID=pc.CustomerID
  WHERE pc.CustomerID='$CustomerId'";  
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