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
        if(Auth::check()){
            echo "<br>";
            echo $_SESSION['email'];
            echo "<br>";
            echo $_SESSION['auth'];
        }
    }


    public function contact()
    {
        $view = new View("contact");
    }



}