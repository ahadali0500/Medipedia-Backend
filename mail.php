<?php
// Function to send the email
function sendEmail($to, $subject, $recipientName) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Medipedia <noreply@desired-techs.com>" . "\r\n";

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
            .content h1 {
                font-size: 22px;
                margin-bottom: 20px;
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
                background-color: #28a745;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                margin-top: 20px;
            }
            .footer {
                background-color: #f4f4f4;
                text-align: center;
                padding: 10px;
                font-size: 14px;
                color: #777777;
                border-top: 1px solid #dddddd;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <br>
            <center><img style="width:60px" src="https://medipedia-web-api.desired-techs.com/img/logo.png" ></center>
            <div class="content">
                <p>Code has been assigned to your applied books so kindly check your app and websites and start solving MCQs.</p>
            </div>
            <div class="footer">
                &copy; 2024 Desired Technology. All rights reserved.<br>
            </div>
        </div>
    </body>
    </html>';

    if(mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully to $to";
    } else {
        echo "Failed to send email to $to";
    }
}

// Example usage
sendEmail('ahadali0500@gmail.com', 'Important Updates', 'John Doe');
?>
