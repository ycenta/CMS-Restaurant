<html>
    <head>
        <title>List</title>
    </head>
    <body>
        <h1>List of pages</h1>
        <ul>
            <?php foreach ($pages as $page): ?>
                <li>
                    <a href="/readpage?slug=<?php echo $page->getSlug(); ?>"><?php echo $page->getTitle(); ?></a>
                    <a href="/editpage?slug=<?php echo $page->getSlug(); ?>">Edit</a>
                    <a href="/deletepage?slug=<?php echo $page->getSlug(); ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        if($pages_amount > 1){
        ?>
            <nav>
                <ul class="pagination">
                    <?php
                    if($currentPage != 1){
                    ?>
                        <li><a href="/list?page=<?= $currentPage - 1 ?>">Précédent</a></li>
                    <?php
                    }
                    for($i = 1;$i<=$pages_amount;$i++):
                    ?>
                        <li><a href="./list?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    endfor;
                    if($currentPage != $pages_amount){
                    ?>
                        <li><a href="./list?page=<?= $currentPage + 1 ?>">Suivant</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        <?php
        }
        ?>
        <a href="/newpage">Create a new page</a>  
    </body>
</html>