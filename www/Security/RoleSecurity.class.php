<?php

namespace App\Security;

use App\Core\Sql;
use App\Model\Role;

class RoleSecurity extends Sql
{

    public function __construct()
    {
        parent::__construct('role', Role::class);
    }


    public function findById(int $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }

    public function getRoleNameById(int $id)
    {
        $result = $this->findById($id);

        if($result){
            return $result->getName();
        }else{
            return 'user';
        }
    }

}