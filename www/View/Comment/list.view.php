<html>
    <head>
        <title>Liste Commentaires</title>
    </head>
    <body>
        <h1>Liste des Commentaires</h1>
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <?= $comment->getContent()?> - <?= $comment->getVerified() ?'Validé':'Non validé'; ?> - <?= $comment->getReported() ?'Reported':'Pas reported'; ?> <div id="activate" style="display: inline-block;"><?php $this->includePartial("form", $comment->getActivateCommentForm()) ?>   </div>  <div id="delete" style="display: inline-block;"><?php $this->includePartial("form", $comment->getRemoveCommentForm()) ?>   </div>               
                </li>
            <?php endforeach; ?>
        </ul>
</html>