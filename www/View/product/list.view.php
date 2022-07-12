<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des produits</title>
        <meta name="description" content="Description de ma page">
    </head>
    <body>

        <h1>Liste des produits</h1>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <h3>Id : <?= $product->getId()?></h3>
                    <span> <?= $product->getName(); ?> </span>
                    <span> <img src="Public/img/product/<?= $product->getPicture(); ?>" alt="<?= $product->getName(); ?>"> </span>
                    <span> <?= $product->getDescription(); ?> </span>
                    <span> <?= $product->getPrice(); ?> €</span>
                    <span> <?= $product->getStock() == 0 ? 'Rupture' : $product->getStock(); ?> </span>
                    <a href="/product?id=<?= $product->getId(); ?>"><button>Modifier</button></a>
                    <div id="delete" style="display: inline-block;">
                        <?php $this->includePartial("form", $product->getRemoveProductForm()) ?> 
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

    </body>
</html>