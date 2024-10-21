<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

$qry = "SELECT * FROM  speclization WHERE status = '1'";
$result = $con->query($qry);

while($row = $result->fetch_assoc())
{
    $data[] = $row;
}
    echo json_encode($data);
?>