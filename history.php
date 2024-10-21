<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

$id = $_POST['user_id']; 

// Query to retrieve data and count of questions for each test_id
$qry = "SELECT result.*, test.*, COUNT(question.id) AS total_questions
        FROM `result`
        INNER JOIN `test` ON test.id = result.test_id
        LEFT JOIN `question` ON question.test_id = result.test_id
        WHERE result.user_id='$id'
        GROUP BY result.test_id";
$result = $con->query($qry);

$data=[];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
