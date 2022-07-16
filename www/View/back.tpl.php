<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
        <meta name="description" content="Description de ma page">
		<title>Template BACK</title>
		<link rel="stylesheet" type="text/css" href="public/main.css">
		<script src="https://kit.fontawesome.com/f3633012bb.js" crossorigin="anonymous"></script>
	</head>
	<script type="text/javascript" src="public/main.js"></script>
	<body>
        
		<header>
			<div class="container">
				<span class="title_navbar">Nom du site</span>
				<span class="profil_pic">
					photo
                    <?php //echo $user->getFirstname() ?>
				</span>
			</div>
		</header>
		<div class="sidebar">
				 	<ul>
					<li><a href="/dashboard"> <i class="fa-solid fa-house"></i> </a></li> 
					 <li><a href="/checkouts"><i class="fa-solid fa-dollar-sign"></a></i></li> 
					 <li><a href="/products"><i class="fa-solid fa-box"></a></i> </li>
					 <li><a href="/categories"><i class="fa-solid fa-tags"></i></a> </li>
					<li><a href="/users"> <i class="fa-solid fa-user"></i></a> </li>
					<li> <a href="/comments"><i class="fas fa-comment"></i> </a> </li>
					<li> <a href="/list"><i class="fa-solid fa-file"></i> </a> </li>
					<li> <i class="fa-solid fa-gear"></i> </li>
					</ul>
		</div>
		<div class="container">
                <?php include "View/".$this->view.".view.php"; ?> 
                     
			<!-- <section class="graph-container"> -->
				<!-- <div >
					<p class="graphtitle">Vente des 30 derniers jours</p>
					 <div class="button button--dark select">
						Echelle
						<i class="fa-solid fa-angle-down"></i>
						<ul style="display: none;">
							<li>Pas visibilité</li>
						</ul>
					</div>
						<img src="assets/images/Graphique.svg" width="100%">
				</div> -->
			<!-- </section> -->
	

		
		</div>
	</body>



</html>