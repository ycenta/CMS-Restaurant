<html>
    <head>
        <title>Page user</title>
    </head>
    <body>
        <h1>Utilisateur</h1>
        <h3>Informations : </h3>
        <div>
            <span>Email : </span><span><?= $user->getEmail();?></span>
        </div>
        <?php $this->includePartial("form", $user->getEditUserForm()) ?>
</html>