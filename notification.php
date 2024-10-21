<?php
include("connection.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Initialize arrays to store categorized data
$book1 = [];   // For book type 1 (record_type -1)
$book2 = [];   // For book type 2 (record_type -3)
$mock1 = [];   // For mock type 1 (record_type -2)
$mock2 = [];   // For mock type 2 (record_type -4)
$separate = []; // For separate records (record_type 0)

// Fetch user_id from POST request
$user_id = $_POST['user_id'];

// SQL query to fetch notifications for the specified user_id
$qry1 = "SELECT * FROM `notification` WHERE `user_id`= '$user_id'";
$result1 = $con->query($qry1);

// Check if the query execution was successful
if ($result1) {
    // Loop through each row of the result
    while ($row = $result1->fetch_assoc()) {
        // Separate data based on the record_type value
        switch ($row['type']) {
            case 0:
                $separate[] = $row; // Separate records
                break;
            case -1:
                $book1[] = $row; // Book type 1
                break;
            case -2:
                $mock1[] = $row; // Mock type 1
                break;
            case -3:
                $book2[] = $row; // Book type 2
                break;
            case -4:
                $mock2[] = $row; // Mock type 2
                break;
            default:
                // Add any additional handling if necessary
                break;
        }
    }
} else {
    echo json_encode(['error' => 'Failed to execute query: ' . $con->error]);
    exit();
}

// Structure the response with categorized data
$response = [
    'separate' => $separate,
    'book1' => $book1,
    'book2' => $book2,
    'mock1' => $mock1,
    'mock2' => $mock2
];

// Encode the result data as JSON and echo it
echo json_encode($response);
?>
