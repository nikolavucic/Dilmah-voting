<?php

    $votes = $_POST['votes'];
    $name = $_POST['name'];
    $nric = $_POST['nric'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    define('SMTP_SERVER', 'smtp.gmail.com'/*smtp.live.com (if you use hotmail, port is same)*//*smtp.mail.yahoo.com (if you use yahoo mail, port is same)*//*
    smtp.live.com (for outlook mail port is 587 */);
    define('SMTP_USER', 'dilmahhightea@gmail.com');
    define('SMTP_PASSWORD', 'dilmahtea');
    define('SMTP_PORT', '465');
    define('SMTP_SSL', 1);

    require_once 'email/swift_required.php';

    $subject = '';
    $from = SMTP_USER;
            
    /*YOUR E-MAIL*/ $to = 'example@yahoo.com'; /*YOUR E-MAIL*/
           
    $body = "<div align=\"center\" style=\"background-color:#007c85;color:white;padding-left: 35px;padding-top: 30px;padding-right: 35px;padding-bottom:30px;\"><h1>My vote goes to: $votes</h1> <br>
        <h3>My name: $name </h3>
        <h3> Nric: $nric </h3>
        <h3> My email: <span  style=\"color:white;\">$email </span> </h3>
        <h3> Contact Number: $contact </h3> </div> ";

    // Create the Transport
    $transport = Swift_SmtpTransport::newInstance()->setHost(SMTP_SERVER);
    $transport->setPort(SMTP_PORT);
    $transport->setUsername(SMTP_USER);
    $transport->setPassword(SMTP_PASSWORD);
        if (SMTP_SSL) {
        $transport->setEncryption('ssl');
            }

    // Create the Mailer using your created Transport
    $mailer = Swift_Mailer::newInstance($transport);

    // Create a message
    $message = Swift_Message::newInstance($subject);
    $message->setFrom($from);
    $message->setTo($to);
    $message->setBody($body);
    $message->setContentType("text/html");
    $message->setPriority(3);
    $message->getHeaders()->addTextHeader('User-Agent', 'Mozilla Thunderbird 1.5.0.8 (Windows/20061025)');

    // Send the message
    $result = $mailer->send($message);

    header ('Location: voted.php');





