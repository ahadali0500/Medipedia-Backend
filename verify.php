<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
include('connection.php');
if (isset($_GET['code'])) {
    $verificationCode = $_GET['code'];
    $conn = $con->prepare('SELECT `email` FROM `users_verification` WHERE `verification_code` = ?');
    $conn->bind_param("s", $verificationCode);
    $conn->execute();
    $conn->store_result();
    if ($conn->num_rows > 0) {
        $conn->bind_result($email);
        $conn->fetch();
        $updateConn = $con->prepare('UPDATE `signup` SET `is_verified` = 1 WHERE `user_email` = ?');
        $updateConn->bind_param("s", $email);
        $updateConn->execute();
        $deleteConn = $con->prepare('DELETE FROM `users_verification` WHERE `verification_code` = ?');
        $deleteConn->bind_param("s", $verificationCode);
        $deleteConn->execute();
        echo json_encode(array("code" => 200, "message" => "Account verified successfully."));
    } else {
        http_response_code(200);
        echo json_encode(array("code" => 400, "message" => "Invalid verification code."));
    }

    $con->close();
} else {
    http_response_code(200);
    echo json_encode(array("code" => 200, "message" => "Verification code not provided."));
}
?>
