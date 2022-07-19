<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;
use App\Model\User as UserModel;



class InstallerController {

    public function __construct()
    {
       
    }

    public  function initproject(){
        $user = new UserModel();

        $view = new View("installer/init");
        $view->assign("user", $user);
    }

}