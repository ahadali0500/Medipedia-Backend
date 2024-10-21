<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include("connection.php");
$userid = $_POST['user_id'];
$feed = $_POST['feed'];


$query = "INSERT INTO feedback (id,user_id,feed_back,status)
VALUES(NULL,'$userid','$feed',0)";

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