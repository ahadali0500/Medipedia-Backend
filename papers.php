<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

// fetching id from slug
$slug = $_POST['slug'];
$qry = "SELECT * FROM  books WHERE slug = '$slug'";
$out = $con->query($qry);
$rows = $out->fetch_assoc();
$book_id=$rows['id'];

// fetching papers
$qry = "SELECT * FROM  papers WHERE book_id = '$book_id' AND status = '1'";
$result = $con->query($qry);

$data = array(); // Initialize an empty array to hold the data

while($row = $result->fetch_assoc()) {
    $data[] = $row; // Add the book data to the main data array
}

 echo json_encode(array("heading" => $rows['book_name'], "data" => $data ));
?>
