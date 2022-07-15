<ul>
    <?php foreach($products as $product): ?>
     <li> <?=$product->getName() ?> </li>   
    <?php endforeach; ?>
</ul>

<?php 
    if(count($products)){
        $this->includePartial("form", $checkout->getCheckoutForm()) ;
    }else{
        echo "Panier Vide";
    }
?>