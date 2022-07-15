<html>
    <head>
        <title>Delete</title>
    </head>
    <body>
        <h1>Delete</h1>
        <form action="<?php echo $this->getUrl("Page", "deletePage"); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $page->getId(); ?>" />
            <input type="submit" value="Delete" />
        </form>
    </body>
</html>