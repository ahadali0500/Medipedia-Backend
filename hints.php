<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

// fetching id from slug
$slug = $_POST['slug'];
$qry = "SELECT * FROM  test WHERE slug = '$slug'";
$out = $con->query($qry);
$rows = $out->fetch_assoc();
$test_id=$rows['id'];

// fetching test_hints
$qry = "SELECT * FROM  test_hints WHERE test_id = '$test_id' AND status = '0'";
$result = $con->query($qry);

$data = array(); 

while($row = $result->fetch_assoc()) {
    $data[] = $row; 
}



 echo json_encode(array("heading" => $rows['test_name'], "data" => $data ));
?>
