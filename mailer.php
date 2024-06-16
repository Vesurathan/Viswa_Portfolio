<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload PHPMailer classes
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = htmlspecialchars($_POST['full-name']);
    $email = htmlspecialchars($_POST['email']);
    $phoneNumber = htmlspecialchars($_POST['phone-number']);
    $message = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;                                      // Enable verbose debug output
        $mail->isSMTP();                                           // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                      // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
        $mail->Username   = 'your-email@gmail.com';                // SMTP username
        $mail->Password   = 'your-password';                       // SMTP password
        $mail->SMTPSecure = 'tls';                                 // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                   // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $fullName);
        $mail->addAddress('vesurathan@gmail.com');                 // Add a recipient

        // Content
        $mail->isHTML(true);                                       // Set email format to HTML
        $mail->Subject = 'Contact Form Submission from ' . $fullName;
        $mail->Body    = nl2br("Name: $fullName\nEmail: $email\nPhone: $phoneNumber\n\nMessage:\n$message");

        $mail->send();
        echo "<div class='alert alert-success'>Your message was sent successfully.</div>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Sorry, there was an error sending your message. Please try again later.</div>";
    }
}
?