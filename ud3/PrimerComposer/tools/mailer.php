<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require '../vendor/autoload.php';


if(empty(trim($_POST["correo"]))){
    header("Location:../src/enviaCorreo.php");
}



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    
    $correo=$_POST["correo"];

    if(isset($_POST["asunto"])){
        $sub=$_POST["asunto"];
    }else{
        $sub="";
    }

    if(isset($_POST["cuerpo"])){
        $cuerpo=$_POST["cuerpo"];
    }else{
        $cuerpo="";
    }

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rjorge676@gmail.com';                     //SMTP username
    $mail->Password   = 'beum vxzh aoef xjmq ';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('rjorge676@gmail.com', 'Mailer');
    $mail->addAddress($correo);     //Añade un destinatario
    
    if(!$_FILES['fichero']['error'] > UPLOAD_ERR_OK){
        $fichero=$_FILES["fichero"];
        $mail->addAttachment('/var/tmp/file.tar.gz');
        $mail->addAttachment($fichero["tmp_name"], $fichero["name"]);
    }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $cuerpo;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}