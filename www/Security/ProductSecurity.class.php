<?php

namespace App\Security;

use App\Core\Sql;
use App\Model\Product;

class ProductSecurity extends Sql
{

    public function __construct()
    {
        parent::__construct('product', Product::class);
    }


    public function findById(int $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }
}