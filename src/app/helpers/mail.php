<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// this function (for sending email) needs editing the sender's email details
function send_email($receiver, $receiver_name,  $subject, $body_string)
{
    $smtpUsername = $_ENV['SMTP_USERNAME'];
    $smtpPassword = $_ENV['SMTP_PASSWORD'];
    // SERVER SETTINGS
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $smtpUsername;                        //SMTP username
    $mail->Password   = $smtpPassword;                           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;
    //-------------------------------------------

    //Recipients (change this for every project)
    $mail->setFrom('info@joblinkup.com', 'JobLinkUp');
    $mail->addAddress($receiver, $receiver_name);     //Add a recipient
    // $mail->addReplyTo('<reply to email address>', '<name>');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body_string;  // html

    //send the message, check for errors
    if (!$mail->send()) {
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        return 0;
    } else {
        //echo 'Message sent!';
        return 1;
    }
}
//----------------------------------------------------------------------

