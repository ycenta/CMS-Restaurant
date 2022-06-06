<?php

namespace App\Core;


class Auth
{

    public static function check()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['auth'])){
           return false;
        }else{
            return !empty($_SESSION['auth']);
        }
    }



    public static function authIsAdmin()
    {
        //WIP
        if(!isset($_SESSION['security'])){
           return false;
        }else{
            
            return !empty($_SESSION['security']);
        }
    }

}