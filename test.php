<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

// fetching id from slug
$slug = $_POST['slug'];
$user_id = $_POST['user_id'];
$qry = "SELECT * FROM  papers WHERE slug = '$slug'";
$out = $con->query($qry);
$rows = $out->fetch_assoc();
$papers_id=$rows['id'];

// fetching papers
$qry = "SELECT * FROM  test WHERE paper_id = '$papers_id' AND status = '1'";
$result = $con->query($qry);

$data = array(); // Initialize an empty array to hold the data

while($row = $result->fetch_assoc()) {
    $test_id=$row['id'];
    $qryx = "SELECT * FROM  test_hints WHERE test_id = '$test_id' AND status = '0'";
    $resultx = $con->query($qryx);
    if (mysqli_num_rows($resultx)>0) {
        $row['hints']=true;
    }else{
        $row['hints']=false;
    }

    $qryxn = "SELECT * FROM  quiz_save WHERE test_id = '$test_id' AND user_id = $user_id";
    $resultxn = $con->query($qryxn);
    if (mysqli_num_rows($resultxn)>0) {
        $row['quiz_save']=true;
    }else{
        $row['quiz_save']=false;
    }

    $data[] = $row; // Add the book data to the main data array
}



 echo json_encode(array("heading" => $rows['paper_name'], "data" => $data ));
?>
