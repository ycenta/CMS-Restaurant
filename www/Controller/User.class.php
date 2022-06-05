<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Mailsender;
use App\Core\Verificator;
use App\Core\View;
use App\Core\Auth;
use App\Model\User as UserModel;

class User {

    public function __construct()
    {
        Auth::check();
    }

    public function login()
    {
        $user = new UserModel();
        $view = new View("Login");

        $view->assign("user", $user);
        if(!empty($_POST)){
            $result = Verificator::checkForm($user->getLoginForm(), $_POST);

            if(empty($result)){ // Si pas d'erreur
                $emailToCheck = $_POST['email'];
                $passwordToCheck = $_POST['password'];

                $user = $user->checkLogin($emailToCheck,$passwordToCheck); //On check la paire mail/password
                if($user){ // Si un utilisateur est renvoyé, on crée la session
                    echo "sucess";
                    $_SESSION['auth'] = $user->getId();
                    $_SESSION['email'] = $emailToCheck;
                    header('Location: http://localhost');
                }else{
                    echo "Identifiant ou mot de passe incorrect";
                }
                
            }else{
                echo implode("<br>",$result);
            }

           
        }     

        // $view->assign("pseudo", "Prof");
        // $view->assign("firstname", "Yves");
        // $view->assign("lastname", "Skrzypczyk");

    }


    public function register()
    {
      $user = new UserModel();
      $view = new View("register");

      $view->assign("user", $user);

        if( !empty($_POST)){

            $result = Verificator::checkForm($user->getRegisterForm(), $_POST);
            print_r($result);
            if (empty($result)) {
              $user->setUser();
              $user->save();

              $mailtest = new Mailsender();
              $mailtest->sendMail('register', $user->getEmail(),$user->getFirstname(),"http://localhost/register?activation=".$user->getToken());
            }
            else {
              echo "Erreur";
            }
        
        }


    }


    public function logout()
    {
        echo "Se déco";
    }


    public function pwdforget()
    {
        echo "Mot de passe oublié";
    }

    public function sendmail()
    {
        echo "page d'envoi mail<br>";
        
        $mailtest = new Mailsender();
        $mailtest->sendMail('register',"yohan@mailexemple.com","yohan","https://google.com");
        // sendMail($template, $email, $name, $url = null, $data = null) 

    }

}
