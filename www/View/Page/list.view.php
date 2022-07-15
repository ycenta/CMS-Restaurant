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
        <a href="/newpage">Create a new page</a>  
    </body>
</html>