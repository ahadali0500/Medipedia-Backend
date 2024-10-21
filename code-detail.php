<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

$user_id = $_POST['user_id'];

// fetching papers
$qry = "SELECT * FROM  books_codes WHERE user_id = '$user_id'";
$result = $con->query($qry);

$data = array(); // Initialize an empty array to hold the data

while($row = $result->fetch_assoc()) {
    $data[] = $row; // Add the book data to the main data array
}

 echo json_encode($data);
?>
