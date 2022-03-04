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

    private $mail;
  

    public function __construct(){

            $this->mail = new PHPMailer(true);
            $this->mail->IsSMTP();
            $this->mail->Host = HOSTMAIL;
            $this->mail->SMTPAuth = true;
            $this->mail->Port = 2525;
            $this->mail->Username = MAILUSERNAME;
            $this->mail->Password = MAILPWD;
            $this->mail->setFrom(SETMAIL);
            $this->mail->SMTPSecure = 'tls';
            
    }

    public function sendRegisterMail($email,$name,$url){

        try {
           
            $this->mail->addAddress($email);      
            $this->mail->isHTML(true);      
            
            $this->mail->Subject = "Confirmation Inscription NomDuSite";
            $this->mail->Body = "<h1>Bienvenue $name !</h1><p>Veuillez confirmer votre inscription en cliquant sur le lien <span>$url</span> </p>";

            $this->mail->send();
            echo 'Message Register has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {mail->ErrorInfo}";
        }
        
    }


    public function sendForgotMail($email,$name,$url){

        try {
           
            $this->mail->addAddress($email);      
            $this->mail->isHTML(true);      
            
            $this->mail->Subject = "Changement de mot de passe";
            $this->mail->Body = "<h1>Bonjour $name !</h1><p>Veuillez cliquer sur le lien pour reintinialiser votre mot de passe <span>$url</span> </p>";

            $this->mail->send();
            echo 'Message Forgot has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {mail->ErrorInfo}";
        }
        
    }

    public function sendCustomMail($email,$name, $data) 
    {

        try {
           
            //From-to-type
            $this->mail->setFrom($this->mailusername);
            $this->mail->addAddress($email);      
            $this->mail->isHTML(true);      
            
            //Contenu du mail

                // mail->Subject = 'sujet mail';
                // mail->Body    = 'Je suis un mail bonjour<b>in bold!</b>';
                // mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->Subject = $data['subject'];
            $this->mail->Body = $data['body'];

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {mail->ErrorInfo}";
        }


    }


}