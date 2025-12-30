<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $fname   = htmlspecialchars(trim($_POST["fname"] ?? ""));
    $lname   = htmlspecialchars(trim($_POST["lname"] ?? ""));
    $phone   = htmlspecialchars(trim($_POST["phone"] ?? ""));
    $email   = htmlspecialchars(trim($_POST["email"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    // Validate required fields
    if (empty($fname) || empty($lname) || empty($phone) || empty($email)) {
        echo "Please fill all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Email details
    $to = "info@ecomeraz.com";
    $subject = "New Contact Form Query - Ecom Eraz";

    $body = "
    New contact form submission:

    First Name: $fname
    Last Name: $lname
    Mobile Number: $phone
    Email Address: $email

    Message:
    $message
    ";

    $headers  = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        echo "error";
    }

} else {
    echo "Invalid request.";
}
?>
