<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include("connection.php");

// Check if email and password are sent through POST request
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Escape user inputs to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $user_id);

    // Query to fetch user data based on email and password
    $qry = "SELECT * FROM signup WHERE id = '$user_id'";
    $result = mysqli_query($con, $qry);

    if($result) {
        // Check if any rows are returned
        if(mysqli_num_rows($result) > 0) {
            // Fetch user data as an associative array
            $data = mysqli_fetch_assoc($result);
            // Encode the associative array as JSON and output it
            echo json_encode($data);
        } 
    } 
} 
?>
