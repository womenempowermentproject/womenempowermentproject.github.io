<?php
// Change these settings to match your email address and preferences
$to_email = "ypmzolisa@gmail.com";
$subject = "New contact form submission";
$from_email = "softwarebylambda@gmail.com";
$from_password = "kidpretty";
$redirect_url = "https://azaniamzolisa.github.io/weproject.github.io";

// Get the form fields
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

// Validate the form data
if (empty($name) || empty($email) || empty($message)) {
    die("Error: All fields are required.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email address.");
}

// Compose the email message
$body = "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Message: $message\n";

// Set the email headers
$headers = "From: $from_email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send the email using Gmail SMTP
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $from_email;
    $mail->Password = $from_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email content
    $mail->setFrom($from_email);
    $mail->addAddress($to_email);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->CharSet = "UTF-8";
    $mail->send();

    // Redirect to the thank-you page
    header("Location: $redirect_url");
    exit;
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
