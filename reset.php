<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// Retrieve the data from the request body
include("connection.php");

$user_id = $_POST['user_id'];
$test_id = $_POST['test_id'];

echo $user_id;

// verify that alredy quiz saved or not if yes then delete to insert new
// $aa="SELECT * FROM `quiz_save` WHERE user_id=$user_id AND test_id='$test_id'";
// $aac=mysqli_query($con,$aa);
// if (mysqli_num_rows($aac)>0) {
//     $vv="DELETE FROM `quiz_save` WHERE user_id=$user_id AND test_id='$test_id'";
//     mysqli_query($con,$vv);

//     $xx="DELETE FROM `skip` WHERE user_id=$user_id AND test_id='$test_id'";
//     mysqli_query($con,$xx);
// }

//     // Example response
//     $response = ['success' => true];
//     echo json_encode($response);

?>


