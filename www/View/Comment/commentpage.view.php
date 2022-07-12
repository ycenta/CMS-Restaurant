<h2>Commentaires</h2>
<ul>
    <?php foreach ($comments as $comment): ?>
        <li><p>Utilisateur: </p>
            <p><?= $comment->getContent()?> </p>         
        </li>
    <?php endforeach; ?>
</ul>

<?php if(!empty($_SESSION['auth']) && $_SESSION['auth']){
        echo "connecté";
        include "View/Comment/new.view.php"; 
    }
?>
