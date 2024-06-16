<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = htmlspecialchars($_POST['full-name']);
    $email = htmlspecialchars($_POST['email']);
    $phoneNumber = htmlspecialchars($_POST['phone-number']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = "vesurathan@gmail.com";
    $subject = "Contact Form Submission from $fullName";
    $body = "Name: $fullName\nEmail: $email\nPhone: $phoneNumber\n\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Your message was sent successfully.');</script>";
    } else {
        echo "<script>alert('Sorry, there was an error sending your message. Please try again later.');</script>";
    }
}
?>
