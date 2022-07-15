<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Checkout as CheckoutModel;
use App\Model\Checkout_Product as CheckoutProductModel;
use App\Security\ProductSecurity;



class CheckoutController {

    public function generateCheckout()
    {
        if(!empty($_POST)){
            //Rajouter verification si le panier est vide, alors rien faire
            $checkout = new CheckoutModel();
            $checkout_product = new CheckoutProductModel();

            $checkout->setCheckout();
            $checkout->save();

            $checkout_product->addProductToCheckout($checkout->getLastInsertId(),$_SESSION['cart']);

            echo "id: ".$checkout->getLastInsertId();
            echo "<br>";
            echo "Panier payé !";
            //Rajouter verif si tous les produits on été bien été insert
            $_SESSION['cart'] = [];
            header('Location: /shoppingCart?success=true');

        }
    }

}