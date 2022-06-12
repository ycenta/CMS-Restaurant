<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;


class Main {

    public function __construct()
    {
       
    }

    public function home()
    {
        echo "Page d'accueil";
        if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])){
            echo "<br>";
            echo $_SESSION['email'];
            echo "<br>";
        }
    }


    public function contact()
    {
        $view = new View("contact");
    }



}