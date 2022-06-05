<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;


class Main {

    public function __construct()
    {
        Auth::check();
    }

    public function home()
    {
        echo "Page d'accueil";
        echo $_SESSION['email'];
    }


    public function contact()
    {
        $view = new View("contact");
    }



}