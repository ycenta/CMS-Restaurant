<html>
   <head>
      <title>Read</title>
    </head>
    <body>
        <h1><?= $page->getTitle();?></h1>
        <p>
            <?= $page->getContent(); ?>
        </p>

        <?php include "View/Comment/commentpage.view.php"; ?>

    </body>
</html>