<?php
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
   header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

   
include("connection.php");


if(isset($_POST['user_email']))
{
$user_id = $_POST['user_id'];
$email   = $_POST['user_email'];
$qry = "UPDATE signup set user_email = '$email' WHERE id = '$user_id'";
$result = $con->query($qry);
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
}

if(isset($_POST['user_pass']))
{
$user_id = $_POST['user_id'];
$pass   = $_POST['user_pass'];
$qry = "UPDATE signup set user_pass = '$pass' WHERE id = '$user_id'";
$result = $con->query($qry);
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
}

if(isset($_POST['user_name']))
{
$user_id = $_POST['user_id'];
$name   = $_POST['user_name'];
$qry = "UPDATE signup set user_name = '$name' WHERE id = '$user_id'";
$result = $con->query($qry);
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
}

if(isset($_POST['user_no']))
{
$user_id = $_POST['user_id'];
$num   = $_POST['user_no'];
$qry = "UPDATE signup set user_no = '$num' WHERE id = '$user_id'";
$result = $con->query($qry);
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
}


?>