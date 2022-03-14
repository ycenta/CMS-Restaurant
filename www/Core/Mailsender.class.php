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

            ob_start();
            include "View/Template/Mail/register.mail.php";
            $template = ob_get_clean();


            $this->mail->Body = $template;
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

    public function includeMailTemplate($template, $variables):void
    {
        if(!file_exists("View/Template/Mail/".$template.".mail.php")){
            die("Le partial ".$template." n'existe pas");
        }
        include "View/Template/Mail/".$template.".mail.php";
    }


    public function sendCustomMail($template, $email, $name, $url = null, $data = null) 
    {

        try {
           
            $this->mail->addAddress($email);      
            $this->mail->isHTML(true);      
            
            if($template == 'register'){
                $this->mail->Subject = "Confirmation Inscription NomDuSite";
            }else{
                $this->mail->Subject = "NomDuSite";
            }

            $variables = [];
            $variables['email'] = $email;
            $variables['name'] = $name;
            $variables['url'] = $url;
            $variables['data'] = $data;

            ob_start();
            $this->includeMailTemplate($template, $variables);
            $template = ob_get_clean();

            $this->mail->Body = $template;
            $this->mail->send();

            echo 'Message Register has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {mail->ErrorInfo}";
        }


    }


   


}