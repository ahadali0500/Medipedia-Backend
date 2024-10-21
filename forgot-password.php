<?php
header("Access-Control-Allow-Origin: *"); // Adjust this in production to specific domains
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('connection.php');

$email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : null;

if ($email) {
    $sql = "SELECT * FROM `signup` WHERE `user_email` = '$email'";
    $queryResult = mysqli_query($con, $sql);

    if ($queryResult === false) {
        error_log(mysqli_error($con)); // Log any SQL errors
        echo json_encode(array("code" => 500, "message" => "Database query failed.", "Success" => false));
        exit();
    }

    if (mysqli_num_rows($queryResult) > 0) {
        $verificationCode = generateVerificationCode();

        // Prepare the statement
        $stmt = $con->prepare('INSERT INTO `codeRecoverPassword`(`email`, `code`) VALUES (?, ?)');
        if ($stmt === false) {
            error_log(mysqli_error($con)); // Log any preparation errors
            echo json_encode(array("code" => 500, "message" => "Database error during prepare.", "Success" => false));
            exit();
        }

        $stmt->bind_param("ss", $email, $verificationCode);

        // Execute and check for success
        if ($stmt->execute()) {
            $from = "Medipedia <noreply@desired-techs.com>";
            $headers = "From: $from\r\n";
            $headers .= "Reply-To: $from\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $subject = "Recover Password";
            $message = '
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Email Template</title>
                        <style>
                            body {
                                margin: 0;
                                padding: 0;
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                            }
                            .container {
                                width: 100%;
                                max-width: 600px;
                                margin: 0 auto;
                                background-color: #ffffff;
                                border: 1px solid #dddddd;
                            }
                            .header {
                                background-color: #007bff;
                                color: #ffffff;
                                padding: 20px;
                                text-align: center;
                                font-size: 24px;
                                font-weight: bold;
                            }
                            .content {
                                padding: 20px;
                                font-size: 16px;
                                color: #333333;
                            }
                            .content p {
                                line-height: 1.5;
                                margin-bottom: 20px;
                            }
                            .button {
                                display: block;
                                width: 200px;
                                margin: 0 auto;
                                padding: 10px;
                                text-align: center;
                                background-color: #19b2ee;
                                color: #ffffff;
                                text-decoration: none;
                                border-radius: 5px;
                                font-size: 16px;
                                margin-top: 20px;
                            }
                        </style>
                    </head>
                    <body>
                    <div class="container">
                        <br>
                        <center><img style="width:100px" src="https://medipedia.vercel.app/assets/images/logo/logo.png"><h2>Medipedia</h2></center>
                        <div class="content">
                            <p style="color: black;">We received a request to reset your password. If you didn\'t make this request, you can ignore this email.</p>
                            <p style="color: black;">Otherwise, click the button below to set a new password and regain access to your account:</p>
                            <a style="color: #ffffff;" href="https://medipedia.vercel.app/recover-password/' . $verificationCode . '" class="button">Recover password</a>
                        </div>
                    </div>
                </body>
                </html>
            ';

            // Attempt to send the email
            if (mail($email, $subject, $message, $headers)) {
                echo json_encode(array("code" => 200, "message" => "Recovery link has been sent successfully!", "Success" => true));
            } else {
                error_log(error_get_last()['message']); // Log any mail errors
                echo json_encode(array("code" => 400, "message" => "Failed to send email. Please try again later.", "Success" => false));
            }
        } else {
            error_log(mysqli_error($con)); // Log execution errors
            echo json_encode(array("code" => 500, "message" => "Failed to insert code into the database.", "Success" => false));
        }

        $stmt->close(); // Always close the statement after execution
    } else {
        echo json_encode(array("code" => 400, "message" => "Email not found in our records!", "Success" => false));
    }
} else {
    echo json_encode(array("code" => 400, "message" => "Invalid email.", "Success" => false));
}

function generateVerificationCode() {
    return bin2hex(random_bytes(16));
}
?>
