<h2>Commentaires</h2>
<ul>
    <?php foreach ($comments as $comment): ?>
        <?php if($comment->getVerified() === 1): ?>
        <li><p>Utilisateur: <?= $userSecurity->getUserNameById($comment->getIdUser()) ;?></p>
            <span><?= stripslashes($comment->getContent())?> <div id="signaler" style="display:inline-block" ><?= $this->includePartial("form", $comment->getReportCommentForm()) ?></div></span>         
        </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>

<?php if(!empty($_SESSION['auth']) && $_SESSION['auth']){
        include "View/Comment/new.view.php"; 
    }else{
        echo "connectez vous pour poster un commentaire";
    }
?>
