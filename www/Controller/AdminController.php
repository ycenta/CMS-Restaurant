<?php

namespace App\Controller;
use App\Core\Auth;
use App\Core\View;


class AdminController
{
    public function __construct()
    {
       
    }

    public function dashboard()
    {
        
        echo "Ceci est un beau dashboard";
        $view = new View('test','back');

        
    }

}