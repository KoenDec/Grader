<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

class Mailer
{

  public static function mailPasswordTo($to,$pw) {
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "noreply.clw@gmail.com";
    //Password to use for SMTP authentication
    $mail->Password = "NoReplyMail";
    //Set who the message is to be sent from
    $mail->setFrom('noreply.clw@gmail.com');
    //Set who the message is to be sent to
    $mail->addAddress($to);
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->isHTML(true);
    $mail->Subject = 'Paswoord voor rapport';
    $mail->Body    = 'Je paswoord is: ' . $pw;
    $mail->AltBody = 'Je paswoord is: ' . $pw;

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
  }

  public static function generatePassword() {
    $seedings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i=0; $i < 8; $i++)
    {
        $str .= substr($seedings, mt_rand(0, strlen($seedings) -1), 1);
    }
    return $str;
  }
}
