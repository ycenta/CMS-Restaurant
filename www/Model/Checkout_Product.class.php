<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;

class Checkout_Product extends Sql
{
    protected $id;
    protected $id_checkout;
    protected $id_product;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id_user
     */
    public function setIdCheckout(int $id_checkout): void
    {
        $this->id_checkout = $id_checkout;
    }

    /**
     * @return null|int
     */
    public function getIdCheckout(): ?int
    {
        return $this->id_user;
    }

      /**
     * @param int $id_user
     */
    public function setIdProduct(int $id_product): void
    {
        $this->id_product = $id_product;
    }

    /**
     * @return null|int
     */
    public function getIdProduct(): ?int
    {
        return $this->id_product;
    }


    public function addProductToCheckout($id_checkout,$productIdList){

        foreach($productIdList as $productId){
            $this->setIdCheckout($id_checkout);
            $this->setIdProduct($productId);
            $this->save();
        }
       

    }


    public function getProductsOfCheckoutById($id_checkout){

        $checkout_products = $this->getAllWhere(['id','id_checkout','id_product'],['id_checkout',$id_checkout]);
        // $allUsers = [];
        // foreach($users as $user){
        //     $allUsers[$user->getId()] = $user->getFirstname().' - '.$user->getLastname().' - '.$user->getEmail();
        // }
        return $checkout_products;

    }
 

}