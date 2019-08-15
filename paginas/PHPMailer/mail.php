<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
////////////////////////Datos Confirguracion del Correo/////////////////
$mail = new PHPMailer(true);
try {
    $mail = new PHPMailer();  // create a new object
    /*
    $mail->Host = 'a2plcpnl0253.prod.iad2.secureserver.net';
    $mail->Port = 465; 
    $mail->Username = 'enriquealducin@siswebs.com.mx';  
    $mail->Password = 'Portero1';
    */
    
    $mail->SMTPDebug  = 1;
    $mail->Host = 'mail.siswebs.com.mx';
    $mail->Port = 465; 
    $mail->Username = 'enriquealducin@siswebs.com.mx';  
    $mail->Password = 'Portero1.';
    //Recipients
    $mail->setFrom(($correoFrom), $nameFrom);
  
    $mail->addAddress($correoTo);
    
    
    
    /*
    print_r($correo_envia);
      $mail->setFrom('enriquedamasco58@gmail.com','Sisweb CEO');
      
      */
    //$mail->addAddress('enriquealducin@outlook.com', 'Enrique Alducin');     // Add a recipient
    //$mail->addAddress('enriquedamasco58@gmail.com');               // Name is optional
    /// para responder $mail->addReplyTo('info@example.com', 'Information');
   
    //con copia $mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpo;
    // $mail->AltBody = 'Por si no reconoce el html';
    $mail->CharSet = 'UTF-8';
    
    if(!$mail->send()) {
        $error = 'Mail error: '.$mail->ErrorInfo; 
        echo "No se pudo mandar el Correo";
    } else {
        echo 'Correo Enviado';
    } 

    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
////////////////////////Datos Confirguracion del Correo/////////////////

?>