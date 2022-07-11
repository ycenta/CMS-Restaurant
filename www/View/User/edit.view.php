<h1 class="title">Utilisateur</h1>

<div class="table">
<div class="table-head">
          <div class="tab">
            <p>Informations :</p>
          </div>
        </div>
    <div class="table-body"> 
            <div>
                <span>Email : </span><span><?= $user->getEmail();?></span>
            </div>
            <?php $this->includePartial("form", $user->getEditUserForm()) ?>
    </div>
</div>