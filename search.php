<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Retrieve the data from the request body
include("connection.php");

$slug = $_POST['slug'];
$search = $con->real_escape_string($_POST['search']); // Prevent SQL injection

$qry = "SELECT * FROM test WHERE slug = '$slug'";
$out = $con->query($qry);
$rows = $out->fetch_assoc();
$test_id = $rows['id'];

// Check if search term is provided and not empty
if (isset($search) && $search !== '') {
    // Search term is provided

    // Construct the query with search term
    $qry = "SELECT * FROM question WHERE test_id = '$test_id' AND (ques LIKE '%$search%' OR op1 LIKE '%$search%' OR op2 LIKE '%$search%' OR op3 LIKE '%$search%' OR op4 LIKE '%$search%' OR op5 LIKE '%$search%' OR ans LIKE '%$search%' OR reason LIKE '%$search%')";
    $result = $con->query($qry);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        // For each question, add it to data with default values
        $row['sel_ans'] = null;
        $row['setoptans'] = null;
        $row['skip'] = false;
        $data[] = $row;
    }

    // Return the response
    echo json_encode(array("heading" => $rows['test_name'], "data" => $data));
} else {

    $qry = "SELECT * FROM question WHERE test_id = '$test_id' AND status = '1'";


    $result = $con->query($qry);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        // For each question, add it to data with default values
        $row['sel_ans'] = null;
        $row['setoptans'] = null;
        $row['skip'] = false;
        $data[] = $row;
    }

    echo json_encode(array("heading" => $rows['test_name'], "data" => $data));
}

?>
