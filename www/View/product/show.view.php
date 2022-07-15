<html>
    <head>
        <title><?= $product->getName()?></title>
    </head>
    <body>
        <h1><?= $product->getName()?></h1>
        <div>
            <h3>Informations : </h3>
            <img style="width:200px;height:200px" src="Public/img/product/<?= $product->getPicture(); ?>" alt="<?= $product->getName(); ?>">
            <p><?= $product->getDescription(); ?></p>
            <h4>Prix : <?= $product->getPrice(); ?>€  | Stock : <?= $product->getStock() == 0 ? 'Rupture' : $product->getStock(); ?></h4>
            <div>   <?= $this->includePartial("form",  $product->getAddProductToCart()) ?> </div>
          
        </div>

</html>