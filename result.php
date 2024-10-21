<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// Retrieve the data from the request body
$requestData = json_decode(file_get_contents('php://input'), true);
include("connection.php");


$user_id = $_POST['user_id'];
$test_id = $_POST['test_id'];



$qryy = "SELECT * FROM quiz_save WHERE user_id = '$user_id' AND test_id = '$test_id'";
$ress = mysqli_query($con,$qryy);
$mark = 0;
$total=0;
if (mysqli_num_rows($ress)>0) {
    while($dd=mysqli_fetch_assoc($ress)){
        $mark=$dd['marks']+$mark;
        $total++;
   }  
}


$qryyx = "SELECT * FROM skip WHERE user_id = '$user_id' AND test_id = '$test_id'";
$resss = mysqli_query($con,$qryyx);
if (mysqli_num_rows($ress)>0) {
    while($ddd=mysqli_fetch_assoc($resss)){
        $mark=$ddd['marks']+$mark;
        $total++;
   } 
}

$qryyxb = "SELECT * FROM question WHERE test_id = '$test_id'";
$resssb = mysqli_query($con,$qryyxb);


$dxc="INSERT INTO `result`(`user_id`, `test_id`, `marks`) VALUES ('$user_id','$test_id','$mark')";
$xxx=mysqli_query($con,$dxc);
     
   

$aa="SELECT * FROM `quiz_save` WHERE user_id=$user_id AND test_id='$test_id'";
$aac=mysqli_query($con,$aa);
if (mysqli_num_rows($aac)>0) {
    $vv="DELETE FROM `quiz_save` WHERE user_id=$user_id AND test_id='$test_id'";
    mysqli_query($con,$vv);

    $xx="DELETE FROM `skip` WHERE user_id=$user_id AND test_id='$test_id'";
    mysqli_query($con,$xx);
}

 // Example response
 $response = ['marks' => $mark,"total"=> mysqli_num_rows($ress)];
 echo json_encode($response);

?>


