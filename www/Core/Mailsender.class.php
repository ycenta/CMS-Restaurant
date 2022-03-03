<?php

namespace App\core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';


class Mailsender
{

    private $email;

    public function __construct(){
        //deplacer la config
    }

    public static function registerMail($email,$name, $ect){
        
    }
    public static function sendCustomMail($data): void 
    {

        $mail = new PHPMailer(true);
        try {
 
            //config
            $mail->IsSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = 'tls';
            
            //From-to-type
            $mail->setFrom('from@example.com');
            $mail->addAddress('yohan.centamail');      
            $mail->isHTML(true);      
            
            //Contenu du mail

                // $mail->Subject = 'sujet mail';
                // $mail->Body    = 'Je suis un mail bonjour<b>in bold!</b>';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->Subject = $data['subject'];
            $mail->Body = $data['body'];

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }


}