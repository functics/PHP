<?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('PRC');

require '../PHPMailerAutoload.php';

//define toAddress variable
$toAddress = array(
    array(
        'address' => 'hejianing@wangdian.cn',
        'name'    => 'Mr.HE'
    ),
    array(
        'address' => 'liuhaijun@wangdian.cn',
        'name'    => 'Mr.LIU'
    )
);

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "SMTP.163.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "xxxx@163.com";
//Password to use for SMTP authentication
$mail->Password = "password";
//Set who the message is to be sent from
$mail->setFrom('xxxx@163.com', 'WDT MAIL TEST');
//Set an alternative reply-to address
$mail->addReplyTo('xxxx@163.com', 'WDT MAIL TEST');
//Set the subject line
$mail->Subject = 'PHPMailer SMTP test';
//Set who the message is to be sent to in loop
//Attach an image file
$mail->addAttachment('images/phpmailer_mini.png');
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';


foreach ($toAddress as $value)
{
    $mail->addAddress($value['address'], $value['name']);
}

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}


/**  todo: this can send different message
foreach ($toAddress as $value)
{
    //Set the subject line
    $mail->Subject = 'PHPMailer SMTP test';
    //Set who the message is to be sent to in loop
    //Attach an image file
    $mail->addAttachment('images/phpmailer_mini.png');
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
    $mail->addAddress($value['address'], $value['name']);
    send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
}

**/