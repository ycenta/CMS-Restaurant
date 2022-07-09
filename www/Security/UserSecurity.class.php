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

    public function findByToken(string $token)
    {
       $result = $this->findByCustom("token",$token);
      
      return $result;
    }

    public function findByResetToken(string $reset_token)
    {
       $result = $this->findByCustom("reset_token",$reset_token);
      
      return $result;
    }

    public function getAllUsers()
    {
        $users = $this->getAll(['id','firstname','lastname','email','status']);
        // $allUsers = [];
        // foreach($users as $user){
        //     $allUsers[$user->getId()] = $user->getFirstname().' - '.$user->getLastname().' - '.$user->getEmail();
        // }
        return $users;
    }


    public function validateAccount(string $token)
    {
        $today = date("Y-m-d H:i:s");

        $user = $this->findByToken($token); 
        if(!empty($user)){ // Si on trouve un compte avec le mail correspondant
            if($today < $user->getTokenExpiration()){

                if($user->getStatus() == 0){
                    $user->setStatus(1);
                    $user->save();
                    return "Account is now actived !";
                }else{
                    return "Account is already actived";
                }

            }else{
                return "Activation code is wrong or expired";
            }
                
        }else{
            return "Activation code is wrong or expired (no user) ";
        }
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