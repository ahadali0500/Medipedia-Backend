<?php
include("connection.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$user_id = $_POST['user_id'];
$qry1 = "DELETE FROM `notification` WHERE `user_id`= '$user_id'";
$result1 = $con->query($qry1);
$response['status']="true";
echo json_encode($response);
?>
