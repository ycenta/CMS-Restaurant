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
        $view = new View("Login", "back");

        $view->assign("pseudo", "Prof");
        $view->assign("firstname", "Yves");
        $view->assign("lastname", "Skrzypczyk");

        $_SESSION['id'] = 1;
        $_SESSION['token'] = 'coucou';
        $_SESSION['security'] = 'admin';

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
        session_destroy();
    }


    public function pwdforget()
    {
        echo "Mot de passe oublié";
    }

}





