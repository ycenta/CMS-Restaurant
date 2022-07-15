<?php

namespace App\Middleware;
use App\Core\Middleware;

class RoleMiddleware 
{
    public function __construct()
    {
        // if(session_status() === PHP_SESSION_NONE){
        //     session_start();
        // }
    }

    public function middleware()
    {

        $uri =  strtok($_SERVER["REQUEST_URI"], '?');
        $routeFile = "routes.yml";
        if(!file_exists($routeFile)){
            die("Le fichier ".$routeFile." n'existe pas");
        }
        
        $routes = yaml_parse_file($routeFile);

        if( empty($routes[$uri]) ||  empty($routes[$uri]["controller"])  ||  empty($routes[$uri]["action"]) || empty($routes[$uri]["role"]) ){
            die("Erreur 404");
        }

        $role = array_map('strtolower', ($routes[$uri]["role"]));

        /*
        *
        *  Vérfification de la sécurité, est-ce que la route possède le paramètr rôle
        *  Si oui est-ce que l'utilisation a les droits et surtout est-ce qu'il est connecté ?
        *  Sinon rediriger vers la home ou la page de login
        *
        */


        if(!in_array('none', $role)){

            if(isset($_SESSION['role'])){ //si l'utilisateur est connecté

                if(!in_array($_SESSION['role'],$role)){ 
                    header('Location: /');
                }
            }else{ //sinon 
                header('Location: /login');
            }
        }

        // echo "<br>MiddlewarRole lancé";
    }


}
