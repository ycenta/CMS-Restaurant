<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;


class MainController {

    public function __construct()
    {
       
    }

    public function home()
    {
        echo "Page d'accueil";
        if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])){
            echo "<br>";
            echo "Bienvenue ".$_SESSION['email'];
            echo "<br>";
            echo " Role actuel : ".$_SESSION['role'];
            echo "<br>";
        }
    }


    public function contact()
    {
        $view = new View("contact");
    }



}