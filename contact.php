<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include("connection.php"); // Ensure this file properly connects to your database

$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$feedback = mysqli_real_escape_string($con, $_POST['feed']);

// Simple SQL INSERT query
$sql = "INSERT INTO `contact` (`name`, `email`, `feedback`) VALUES ('$name', '$email', '$feedback')";

if (mysqli_query($con, $sql)) {
    echo json_encode(["message" => "Thanks for contacting us!"]);
} else {
    echo json_encode(["error" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
