<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User {

    public function login()
    {
        $user = new UserModel();
        $view = new View("Login");
        $view->assign("user", $user);
        if( !empty($_POST)){
            $user->setlogin($_POST['email'],$_POST['password']);

        }
        
    
    }


    public function register()
    {

        $user = new UserModel();

        if( !empty($_POST)){

            $result = Verificator::checkForm($user->getRegisterForm(), $_POST);
            print_r($result);

        }

        $view = new View("register");
        $view->assign("user", $user);
    }


    public function logout()
    {
        echo "Se déco";
    }


    public function pwdforget()
    {
        echo "Mot de passe oublié";
    }

}





