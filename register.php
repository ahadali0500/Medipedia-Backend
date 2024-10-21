<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include("connection.php");

// Retrieve form data
$username = $_POST['user_name'];
$useremail = $_POST['user_email'];
$userpass = $_POST['user_pass'];
$userno = $_POST['user_no'];

// Check if email already exists
$query = "SELECT * FROM `signup` WHERE `user_email` = '$useremail'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    // Email already exists
    echo json_encode(array("Success" => "false", "Message" => "Email already exists"));
    exit; // Stop further execution
}

// Check if phone number length is 11 digits
if (strlen($userno) < 11) {
    // Invalid phone number length
    echo json_encode(array("Success" => "false", "Message" => "Phone number must be 11 digits long"));
    exit; // Stop further execution
}

// Insert new user into the database
$insertQuery = "INSERT INTO `signup`(`id`, `user_name`, `user_email`, `user_pass`, `user_no`, `status`) 
                VALUES (NULL,'$username','$useremail','$userpass','$userno','0')";
$insertResult = mysqli_query($con, $insertQuery);
// $verificationCode = generateVerificationCode();

// $dc="INSERT INTO `users_verification`(`email`, `verification_code`) VALUES ('$useremail','$verificationCode')";
// $vv=mysqli_query($con,$dc);
// Send the verification email
// $from = "Medipedia <noreply@desired-techs.com>";
// $headers = "From: $from\r\n";
// $headers .= "Reply-To: $from\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// $subject = "Account Verification";
// $message = '
// <!DOCTYPE html>
// <html lang="en">
//     <head>
//         <meta charset="UTF-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1.0">
//         <title>Email Template</title>
//         <style>
//             body {
//                 margin: 0;
//                 padding: 0;
//                 font-family: Arial, sans-serif;
//                 background-color: #f4f4f4;
//             }
//             .container {
//                 width: 100%;
//                 max-width: 600px;
//                 margin: 0 auto;
//                 background-color: #ffffff;
//                 border: 1px solid #dddddd;
//             }
//             .header {
//                 background-color: #007bff;
//                 color: #ffffff;
//                 padding: 20px;
//                 text-align: center;
//                 font-size: 24px;
//                 font-weight: bold;
//             }
//             .content {
//                 padding: 20px;
//                 font-size: 16px;
//                 color: #333333;
//             }
//             .content h1 {
//                 font-size: 22px;
//                 margin-bottom: 20px;
//             }
//             .content p {
//                 line-height: 1.5;
//                 margin-bottom: 20px;
//             }
//             .button {
//                 display: block;
//                 width: 200px;
//                 margin: 0 auto;
//                 padding: 10px;
//                 text-align: center;
//                 background-color: #19b2ee;
//                 color: #ffffff;
//                 text-decoration: none;
//                 border-radius: 5px;
//                 font-size: 16px;
//                 margin-top: 20px;
//             }
//         </style>
//     </head>
//     <body>
//     <div class="container">
//         <center><img style="width:100px" src="https://medipedia.vercel.app/assets/images/logo/logo.png"><h2>Medipedia</h2></center>
//         <div class="content">
//             <h1>Hello '.$username.',</h1>
//             <p style="color: black;" >Thank you for registering! Please click the button below to verify your email address.</p>
//             <a style="color: #ffffff;" href="https://medipedia.vercel.app/verify/' .$verificationCode . '" class="button">Verify Email</a>
//         </div>
//     </div>
// </body>
// </html>
// ';
// if (mail($useremail, $subject, $message, $headers)) {
    // Successfully inserted
if ($insertResult) {
    echo json_encode(array("Success" => "true", "Message" => "User registered successfully"));
} else {
    echo json_encode(array("Success" => "false", "Message" => "Failed to register user"));
}
function generateVerificationCode()
{
    return bin2hex(random_bytes(16));
}
?>
