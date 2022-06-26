<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Mailsender;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Security\UserSecurity;

class UserController {

    public function __construct()
    {
        // Auth::check();
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

                $userSecurity = new UserSecurity();

                $user = $userSecurity->checkLogin($emailToCheck,$passwordToCheck); //On check la paire mail/password
                if($user){ // Si un utilisateur est renvoyé, on crée la session
                    echo "sucess";
                    $user->generateAuthToken();
                    $user->save();

                    $_SESSION['auth'] = $user->getId();
                    $_SESSION['token'] = $user->getAuthToken();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['firstname'] = $user->getFirstname();
                    $_SESSION['role'] = $user->getRoleId();

                    // $_SESSION['role'] = Role::getRoleById($user->getRoleId());
                    // faire une methode UserSecurity->getRoleById?

                    $view->assign("firstname",  $_SESSION['firstname']);
                    // $view->assign("lastname", "Skrzypczyk");
                    header('Location: /');
                }else{
                    echo "Identifiant ou mot de passe incorrect";
                }
                
            }else{
                echo implode("<br>",$result); //renvoi les erreurs du formulaires
            }
           
        }     

    }


    public function register()
    {
        $user = new UserModel();

        if(isset($_GET['activation']) && !empty($_GET['activation'])){
            $userSecurity = new UserSecurity();
            echo $userSecurity->validateAccount($_GET['activation']); //On check si un compte possède le token
        }else{

            $view = new View("register");

            $view->assign("user", $user);

            if( !empty($_POST)){

                $result = Verificator::checkForm($user->getRegisterForm(), $_POST);
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

    }


    public function logout()
    {
        $view = new View("logout");
        session_destroy();
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