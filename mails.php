<?php 
$to = "ahadali0500@gmail.com";
$subject = "Test Mail";
$message = "Hello! This is a test email sent using the PHP mail function.";
$headers = "From: noreply@desired-techs.com";

if(mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
 ?>