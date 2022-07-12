<html>
    <head>
        <title>Liste Commentaires</title>
    </head>
    <body>
        <h1>Liste des Commentaires</h1>
        <ul>
            <h2> Commentaires signalés </h2>
            <?php foreach ($commentsReported as $commentReported): ?>
                <li>
                    <?= $commentReported->getContent()?> - <?= $commentReported->getVerified() ?'Validé':'Non validé'; ?> - <?= $commentReported->getReported() ?'Reported':'Pas reported'; ?> <div id="activate" style="display: inline-block;"><?php $this->includePartial("form", $commentReported->getActivateCommentForm()) ?>   </div>  <div id="delete" style="display: inline-block;"><?php $this->includePartial("form", $commentReported->getRemoveCommentForm()) ?>   </div>               
                </li>
            <?php endforeach; ?>
        </ul>

        <ul>
            <h2> Commentaires non validés </h2>
            <?php foreach ($commentsUnverified as $commentUnverified): ?>
                <li>
                    <?= $commentUnverified->getContent()?> - <?= $commentUnverified->getVerified() ?'Validé':'Non validé'; ?> - <?= $commentUnverified->getReported() ?'Reported':'Pas reported'; ?> <div id="activate" style="display: inline-block;"><?php $this->includePartial("form", $commentUnverified->getActivateCommentForm()) ?>   </div>  <div id="delete" style="display: inline-block;"><?php $this->includePartial("form", $commentUnverified->getRemoveCommentForm()) ?>   </div>               
                </li>
            <?php endforeach; ?>
        </ul>
        <ul>
            <h2> Tous les commentaires </h2>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <?= $comment->getContent()?> - <?= $comment->getVerified() ?'Validé':'Non validé'; ?> - <?= $comment->getReported() ?'Reported':'Pas reported'; ?> <div id="activate" style="display: inline-block;"><?php $this->includePartial("form", $comment->getActivateCommentForm()) ?>   </div>  <div id="delete" style="display: inline-block;"><?php $this->includePartial("form", $comment->getRemoveCommentForm()) ?>   </div>               
                </li>
            <?php endforeach; ?>
        </ul>
</html>