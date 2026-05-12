<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // Your Gmail
        $mail->Username   = 'orugantipittipavanireddy@gmal.com';

        // Gmail App Password
        $mail->Password   = 'Pavaniii';

        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender
        $mail->setFrom($email, $name);

        // Receiver
        $mail->addAddress('orugantipittipavanireddy@gmal.com');

        // Email Content
        $mail->isHTML(true);

        $mail->Subject = "New Contact Message";

        $mail->Body = "
            <h3>Contact Form Message</h3>

            <b>Name:</b> $name <br><br>

            <b>Email:</b> $email <br><br>

            <b>Subject:</b> $subject <br><br>

            <b>Message:</b><br> $message
        ";

        $mail->send();

        echo "
        <script>
            alert('Message Sent Successfully');
            window.location.href='contact.html';
        </script>
        ";

    } catch (Exception $e) {

        echo "
        <script>
            alert('Message could not be sent');
            window.history.back();
        </script>
        ";
    }

} else {

    header('Location: contact.html');
    exit();
}

?>