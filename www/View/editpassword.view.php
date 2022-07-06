<h1>Page d'édition du mdp</h1>
<h2>changer son mot de passe :</h2>

<?php $this->includePartial("form", $user->getChangePasswordForm()) ?>

<?php 
    echo !empty($message) ? $message : '';
    echo "<br>";
?>

