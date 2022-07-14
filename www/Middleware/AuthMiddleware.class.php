<?php

namespace App\Middleware;
use App\Core\Middleware;
use App\Security\UserSecurity;
use App\Security\RoleSecurity;



class AuthMiddleware 
{
    public function __construct()
    {
    
    }

    public function middleware()
    {

      
        if(isset($_SESSION['auth_token'])){ // Si l'user est connecté, on verifie son token avec celui en base
            $userSecurity = new UserSecurity();
            $roleSecurity = new RoleSecurity();

            $user = $userSecurity->findByAuthToken($_SESSION['auth_token']);

            if($user){ //Si on a bien un utilisateur avec ce token de connexion, on raffraichi les champs en sessions 
                $_SESSION['auth'] = $user->getId();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['firstname'] = $user->getFirstname();
                $_SESSION['role'] = $roleSecurity->getRoleNameById($user->getRoleId());

            }else{ //Sinon on deconnecte & on redirige vers le formulaire de connexion
                session_destroy();
                header('Location: /login');
            }
           
        }

        // echo "MiddlewareAuth lancé";
    }

}
