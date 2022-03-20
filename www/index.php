<?php

namespace App;

use App\Model\User;

require "conf.inc.php";

function myAutoloader($class)
{
    // $class => CleanWords
    $class = str_replace("App\\","",$class);
    $class = str_replace("\\", "/",$class);
    if(file_exists($class.".class.php")){
        include $class.".class.php";
    }
}

spl_autoload_register("App\myAutoloader");

session_start();

if(array_key_exists('id', $_SESSION)){
    $sql = new User();
    $res = $sql->authentification($_SESSION['id'], $_SESSION['token']);
    if(!$res){
        echo('Token invalide');
    }
} else {
    $_SESSION['security'] = 'none';
}

//Réussir à récupérer l'URI
$uri = $_SERVER["REQUEST_URI"];

$routeFile = "routes.yml";
if(!file_exists($routeFile)){
    die("Le fichier ".$routeFile." n'existe pas");
}

$routes = yaml_parse_file($routeFile);

if( empty($routes[$uri]) ||  empty($routes[$uri]["controller"])  ||  empty($routes[$uri]["action"]) || empty($routes[$uri]["security"])){
    die("Erreur 404");
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);
$security = array_map('strtolower', ($routes[$uri]["security"]));


/*
 *
 *  Vérfification de la sécurité, est-ce que la route possède le paramètr security
 *  Si oui est-ce que l'utilisation a les droits et surtout est-ce qu'il est connecté ?
 *  Sinon rediriger vers la home ou la page de login
 *
 */


$controllerFile = "Controller/".$controller.".class.php";
if(!file_exists($controllerFile)){
    die("Le controller ".$controllerFile." n'existe pas");
}
//Dans l'idée on doit faire un require parce vital au fonctionnement
//Mais comme on fait vérification avant du fichier le include est plus rapide a executer
include $controllerFile;

$controller = "App\\Controller\\".$controller;
if( !class_exists($controller)){
    die("La classe ".$controller." n'existe pas");
}
// $controller = User ou $controller = Global
$objectController = new $controller();

if( !method_exists($objectController, $action)){
    die("L'action ".$action." n'existe pas");
}
print_r($security);
if(!in_array($_SESSION['security'], $security) && !in_array('none', $security)){
    die("vous n'avez pas les droits nécessaires");
}
// $action = login ou logout ou register ou home
$objectController->$action();
