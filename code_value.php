<?php

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
$code=code_value();
?>
