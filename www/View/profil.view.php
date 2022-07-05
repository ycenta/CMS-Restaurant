<h1>Page de profil</h1>
<h2>Infos du compte :</h2>

<?php $this->includePartial("form", $user->getProfileForm()) ?>

<a href="/profile-editpassword"> <button>Changer son mot de passe </button></a>
<?php 
    echo !empty($message) ? $message : '';
    echo "<br>";
?>

