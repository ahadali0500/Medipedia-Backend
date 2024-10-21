<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include("connection.php");

// Check if email and password are sent through POST request
if(isset($_POST['user_email']) && isset($_POST['user_pass'])) {
    $email = $_POST['user_email'];
    $pass = $_POST['user_pass'];

    // Escape user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($con, $email);
    $pass = mysqli_real_escape_string($con, $pass);

    // Query to fetch user data based on email and password
    $qry = "SELECT * FROM signup WHERE user_email = '$email' AND user_pass = '$pass'";
    $result = mysqli_query($con, $qry);

    if($result) {
        // Check if any rows are returned
        if(mysqli_num_rows($result) > 0) {
            // Fetch user data as an associative array
            $data = mysqli_fetch_assoc($result);
            // Encode the associative array as JSON and output it
            echo json_encode($data);
        } else {
            // No user found with the provided credentials
            echo json_encode(array("error" => "Invalid email or password"));
        }
    } else {
        // Error in query execution
        echo json_encode(array("error" => "Query failed"));
    }
} else {
    // If email or password is not provided
    echo json_encode(array("error" => "Email or password not provided"));
}
?>
