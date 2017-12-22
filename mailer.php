<?php
require('PHPMailer/PHPMailer.php');
require('PHPMailer/Exception.php');
require('PHPMailer/OAuth.php');
require('PHPMailer/POP3.php');
require('PHPMailer/SMTP.php');

class Mailer
{

public static function mailPasswordTo(/*$to*/) {

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "username@gmail.com";//TODO create a user for gmail
    //Password to use for SMTP authentication
    $mail->Password = "yourpassword";
    //Set who the message is to be sent from
    $mail->setFrom('koen.declerck@student.howest.be', 'Koen');
    //Set who the message is to be sent to
    $mail->addAddress('riwan.carpentier@student.howest.be', 'Riwan');
    //Set the subject line
    $mail->Subject = 'PHPMailer GMail SMTP test';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }

  }

}
