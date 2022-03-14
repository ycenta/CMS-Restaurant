<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Mailsender;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User {

    public function login()
    {
        $view = new View("Login", "back");

        $view->assign("pseudo", "Prof");
        $view->assign("firstname", "Yves");
        $view->assign("lastname", "Skrzypczyk");

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
            }
            else {
              echo "Erreur";
            }



            print_r($_POST);
        
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
        $mailtest->sendCustomMail('register',"test@localhost","yohan","https://google.com");

    }

}
