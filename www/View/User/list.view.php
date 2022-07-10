<html>
    <head>
        <title>Liste users</title>
    </head>
    <body>
        <h1>Liste des users</h1>
        <ul>
            <?php foreach ($users as $user): ?>
                <li>
                   <h3>Id : <?= $user->getId()?></h3> <span> <?= $user->getFirstname(); ?> </span> <span> <?= $user->getLastname(); ?> </span> <span> <?= $user->getEmail(); ?> </span><a href="/user?id=<?= $user->getId(); ?>"><button>Modifier</button></a><div id="delete" style="display: inline-block;"><?php $this->includePartial("form", $user->getRemoveUserForm()) ?> </div>
                </li>
            <?php endforeach; ?>
        </ul>
</html>