<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// Retrieve the data from the request body
$requestData = json_decode(file_get_contents('php://input'), true);
include("connection.php");

// Access the array data
$dataArray = $requestData['data'];
$skiparr = $requestData['skiparr'];
$user_id = $requestData['user_id'];
$duration = $requestData['duration'];
$test_id = $dataArray[0]['test_id'];


$hour = $duration['hours'];
$mint = $duration['minutes'];
$sec = $duration['seconds'];


// verify that alredy quiz saved or not if yes then delete to insert new
$aa="SELECT * FROM `quiz_save` WHERE user_id=$user_id AND test_id='$test_id'";
$aac=mysqli_query($con,$aa);
if (mysqli_num_rows($aac)>0) {
    $vv="DELETE FROM `quiz_save` WHERE user_id=$user_id AND test_id='$test_id'";
    mysqli_query($con,$vv);

    $xx="DELETE FROM `skip` WHERE user_id=$user_id AND test_id='$test_id'";
    mysqli_query($con,$xx);
}

        // Insert Saved Quiz Array
        foreach ($dataArray as $dataItem) {
            $id = $dataItem['id'];
            $f_ans = $dataItem['sel_ans'];
            $t_ans = $dataItem['setoptans'];
            if ($t_ans==$f_ans  && $t_ans!="") {
            $marks=1;
            }else{
                $marks=0;
            }
            if ($t_ans!="" && $f_ans!="") {
                $dd="INSERT INTO `quiz_save`(`user_id`, `test_id`, `marks`, `t_ans`, `f_ans`, `hour`, `mint`, `sec`) VALUES ('$user_id','$test_id','$marks','$t_ans','$f_ans','$hour','$mint','$sec')";
                mysqli_query($con,$dd);
            }
        }

         // insert skip Array
        foreach ($skiparr as $dataItem) {
            $ques_id = $dataItem['id'];
            $f_ans = $dataItem['sel_ans'];
            $t_ans = $dataItem['setoptans'];
            if ($t_ans==$f_ans  && $t_ans!="") {
                $marks=1;
                }else{
                    $marks=0;
                }
            if ($t_ans=="" && $f_ans=="") {
                $dd="INSERT INTO `skip`(`user_id`, `test_id`, `ques_id`,`t_ans`,`f_ans`,`marks`,`status`) VALUES ('$user_id','$test_id','$ques_id','$t_ans','$f_ans','$marks','1')";
                mysqli_query($con,$dd);
            }else{
                $dd="INSERT INTO `skip`(`user_id`, `test_id`, `ques_id`,`t_ans`,`f_ans`, `marks`, `status`) VALUES ('$user_id','$test_id','$ques_id','$t_ans','$f_ans','$marks','0')";
                mysqli_query($con,$dd);
            }
        }

    // Example response
    $response = ['success' => true];
    echo json_encode($response);


?>


