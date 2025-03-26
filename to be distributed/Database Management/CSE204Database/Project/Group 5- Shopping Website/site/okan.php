
<?php
session_start();

$connectect = mysqli_connect("localhost", "root", "", "databaseproject");

$columns = array('first_name', 'last_name');

$query = "SELECT  pt.ProductTypeName , MAX(p.Price) AS 'MAX' , AVG(p.Price) AS 'AVERAGE' ,MIN(p.Price) AS 'MIN' FROM product p 
    INNER JOIN producttype pt ON p.ProductTypeID = pt.ProductTypeID GROUP BY pt.ProductTypeID";

if(isset($_POST["search"]["value"])) {
    $query = "SELECT  pt.ProductTypeName , MAX(p.Price) AS 'MAX' , AVG(p.Price) AS 'AVERAGE' ,MIN(p.Price) AS 'MIN' FROM product p 
    INNER JOIN producttype pt ON p.ProductTypeID = pt.ProductTypeID  WHERE pt.ProductTypeName LIKE '%" . $_POST["search"]["value"]. "%' GROUP BY pt.ProductTypeID";
}


$number_filter_row = mysqli_num_rows(mysqli_query($connectect, $query));


$result = mysqli_query($connectect, $query);


$data = array();

if ($_SESSION["PriceCurrency"] == "$") {
    while($row = mysqli_fetch_array($result))
    {

  
        $sub_array = array();
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="id">' . $row["ProductTypeName"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="nic">' . $row["MAX"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $row["AVERAGE"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $row["MIN"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $_SESSION['PriceCurrency'] . '</div>';

        $data[] = $sub_array;

    }
}elseif ($_SESSION["PriceCurrency"] == "€") {
    while($row = mysqli_fetch_array($result))
    {

        $sub_array = array();
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="id">' . $row["ProductTypeName"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="nic">' . $row["MAX"] * 0.82 . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $row["AVERAGE"] * 0.82 . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $row["MIN"] * 0.82 . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $_SESSION['PriceCurrency'] . '</div>';

        $data[] = $sub_array;

    }
}elseif ($_SESSION["PriceCurrency"] == "₺") {
    while($row = mysqli_fetch_array($result))
    {

        $sub_array = array();
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="id">' . $row["ProductTypeName"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="nic">' . $row["MAX"] * 8.42 . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $row["AVERAGE"] * 8.42 . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $row["MIN"] * 8.42 . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.'" data-column="email">' . $_SESSION['PriceCurrency'] . '</div>';

        $data[] = $sub_array;

    }
}


function get_all_data($connectect)
{
    $query = "SELECT  pt.ProductTypeName , MAX(p.Price) AS 'MAX' , AVG(p.Price) AS 'AVERAGE' ,MIN(p.Price) AS 'MIN' FROM product p 
    INNER JOIN producttype pt ON p.ProductTypeID = pt.ProductTypeID  WHERE pt.ProductTypeName LIKE '%" . $_POST["search"]["value"]. "%' GROUP BY pt.ProductTypeID";
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