<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include_once "autoloader.inc.php";
//Create an instance; passing `true` enables exceptions
if (isset($_POST["subscribe"])) {
    $username = $_POST["name"];
    $email= $_POST["email"]; 
       
    $mail = new PHPMailer(true);


try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'bohdzomobobpeter@gmail.com';                     //SMTP username
    $mail->Password   = 'nymabcsygzilxxil';                    //app password           //SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bohdzomobobpeter@gmail.com', 'Blogger');
    $mail->addAddress($email, $username);
    //Add a recipient


    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Welcome to blogger';
    $mail->Body    = "
            <h3>Hello $username</h3>
            <p>You just subscribed to Blogger's newsletter</p>
            <p>We hope you benifit from this journey</p>
    ";
    if ($mail->send()) {
        $news = new blogContr();
    $news->subscribe($username,$email);
        header("location: ../index.php");
        exit(0);
    }
    else{
        header("location: newsletter.php");
        exit(0);
    }
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
else {
    header("location: ../index.php");
        exit(0);
}