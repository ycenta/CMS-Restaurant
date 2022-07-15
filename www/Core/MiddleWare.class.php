<?php

namespace App\Core;

use App\Security\UserSecurity;


class MiddleWare
{

    public function __construct()
    {

    }

    public static function start(string $middlewarename = null)
    {
        $middlewareFolderPath = "/var/www/html/Middleware/";
        $middlewareList =  scandir($middlewareFolderPath);
        $middlewareList = array_values(array_diff($middlewareList, array('..', '.')));

        foreach($middlewareList as $middleware)
        {
            // echo "<br>";
            include $middlewareFolderPath.$middleware;
            $middleware=str_replace(".class.php",'',$middleware);
            $middleware = 'App\Middleware\\'.$middleware;
            $middleware::middleware();
      
        }

    }

 


}