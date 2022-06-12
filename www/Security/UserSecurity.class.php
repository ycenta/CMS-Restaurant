<?php

namespace App\Security;

use App\Core\Sql;
use App\Model\User;

class UserSecurity extends Sql
{

    public function __construct()
    {
        parent::__construct('user', User::class);
    }


    public function findById(string $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }

    public function findByUsermail(string $usermail)
    {
       $result = $this->findByCustom("email",$usermail);
      
      return $result;
    }



    public function checkLogin(string $usermail,string $userpassword)
    {
        
        $user = $this->findByUsermail($usermail); // On cherche un compte avec le mail correspondant
        if(!empty($user)){ // Si on trouve un compte avec le mail correspondant
            if(password_verify($userpassword, $user->getPassword())){
                return $user;
            }else{
                return false;
            }
                
        }
    }


}