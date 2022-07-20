<h1 class="title">Utilisateurs</h1>

    <section class="resumenumbers">
				<article class="numbers"><p class="bignumbers">1000€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p></article>
				<article class="numbers"><p class="bignumbers">100€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p></article>
				<article class="numbers"><p class="bignumbers">1000€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p></article>
				<article class="numbers"><p class="bignumbers">1000€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p><p class="smallestnumber"><i class="fa-solid fa-arrow-trend-up"></i> 15%</p></article>
	</section>

    <div class="table">
        <div class="table-head">
          <div class="tab">
            <p>Tous les utilisateurs</p>
          </div>
        </div>
        <div class="table-body">
            <ul class="">
                <li> <span>Id</span><span>nom</span><span>prenom</span><span>email</span><span>status</span><span>actions</span>
                <?php foreach ($users as $user): ?>
                    <li>
                    <span> <?= $user->getId()?></span> <span> <?= $user->getFirstname(); ?> </span> <span> <?= $user->getLastname(); ?> </span> <span> <?= $user->getEmail(); ?> </span><span> Statut : <?= $user->getStatus() ?'Validé':'Non validé'; ?> </span><a href="/user?id=<?= $user->getId(); ?>"><button class="button button--white">Modifier</button></a><div id="delete" style="display: inline-block;"><?php $this->includePartial("form", $user->getRemoveUserForm()) ?> </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>




