<html>
    <head>
        <title>Edit</title>
    </head>
    <body>
        <h1>Edit</h1>
        <form method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo $page->getTitle(); ?>" />
            <br></br>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $page->getName(); ?>" />
            <br></br>
            <label for="content">Content</label>
            <textarea name="content" id="content"><?php echo $page->getContent(); ?></textarea>
            <br></br>
            <input type="submit" value="Update" />
        </form>
    </body>
</html>
