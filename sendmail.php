<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = filter_input(INPUT_POST, 'full-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_input(INPUT_POST, 'phone-number', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'dastanviswa@gmail.com';                 // SMTP username
        $mail->Password   = 'Welcome12345+';                  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $fullName);
        $mail->addAddress('vesurathan@gmail.com');                  // Add a recipient

        // Content
        $mail->isHTML(false);                                       // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mailContent = "Full Name: $fullName\nEmail: $email\n";
        if (!empty($phoneNumber)) {
            $mailContent .= "Phone: $phoneNumber\n";
        }
        if (!empty($message)) {
            $mailContent .= "Message: $message\n";
        }
        $mail->Body = $mailContent;

        $mail->send();
        echo "<div class='alert alert-success messenger-box-contact__msg'>Your message was sent successfully.</div>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger messenger-box-contact__msg'>There was a problem sending your message. Please try again. Mailer Error: {$mail->ErrorInfo}</div>";
    }
}
?>
