<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");
$userid = $_POST['user_id'];
$testid= $_POST['test_id'];
$quesid = $_POST['qes_id'];
$report = $_POST['report'];

$query = "INSERT INTO `report`(`id`, `user_id`, `test_id`, `qes_id`, `report`, `status`) 
VALUES (NULL,'$userid','$testid','$quesid','$report',0)";
 

$result = mysqli_query($con,$query);

$arr = [];
if($result)
{
    $arr["Success"] = "true";
}
else
{
    $arr["Success"] = "false";
}
print(json_encode($arr));
?>