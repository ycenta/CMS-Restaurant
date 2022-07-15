<?php

namespace App\Security;

use App\Core\Sql;
use App\Model\Category;

class CategorySecurity extends Sql
{

    public function __construct()
    {
        parent::__construct('category', Category::class);
    }


    public function findById(int $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }
}