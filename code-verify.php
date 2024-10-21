<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");


function code_value(){
    include("connection.php");
    $year_month = date('Y-m');  
    $vv = "SELECT * FROM `code_value` WHERE `year_month` = '$year_month'";
    $dd = mysqli_query($con, $vv);
    
    if (mysqli_num_rows($dd) > 0) {
        // Record found, return existing code_value
        $data = mysqli_fetch_assoc($dd);
        return $data['code_value'];
    } else {

        $max_query = "SELECT MAX(`code_value`) AS max_code FROM `code_value`";
        $max_result = mysqli_query($con, $max_query);
        $max_data = mysqli_fetch_assoc($max_result);
        
        // Increment the code_value based on the max value found
        $new_code_value = isset($max_data['max_code']) ? $max_data['max_code'] + 1 : 1;
        
        // Insert the new code_value
        $xc = "INSERT INTO `code_value`(`year_month`, `code_value`) VALUES ('$year_month','$new_code_value')";
        if (mysqli_query($con, $xc)) {
            return $new_code_value;
        } else {
            return "Error: " . mysqli_error($con);
        }
    }
}

$status=code_value();

$user_id = $_POST['user_id'];  
$bookid = $_POST['book_id'];  
$code = $_POST['code'];  

$qry = "SELECT * FROM books_codes WHERE user_id = '$user_id' AND book_id = '$bookid' AND user_code = '$code'";
$result = $con->query($qry);
$arr=[];
$ddd=mysqli_fetch_assoc($result);
if (mysqli_num_rows($result)>0) {
    if ($ddd['status']<=0) {
        $dd="UPDATE `books_codes` SET `status`='$status'  WHERE user_id = '$user_id' AND book_id = '$bookid'";
        $result = $con->query($dd);
        $arr['Success']="true";
    }else{
        $arr['Success']="false";
    }
    
}else{
    $arr['Success']="not-applied";
}
print(json_encode($arr));
?>