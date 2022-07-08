<html>
    <head>
        <title>List</title>
    </head>
    <body>
        <h1>List of pages</h1>
        <ul>
            <?php foreach ($pages as $page): ?>
                <li>
                    <a href="<?php echo $page->getSlug(); ?>"><?php echo $page->getTitle(); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
</html>