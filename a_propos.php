<?php
$config = json_decode(file_get_contents("./include/config.json"));
$titre = 'A propos';
$titreh1 = 'SSR Food Cergy - A propos';
$datem = 'Apr. 14, 2021';
$description = 'Page qui décrit chaque auteur du projet';
$td = '';
require_once 'include/header.inc.php';
require 'include/util.inc.php';
?>

<div class="container">
	<h1>QUI SOMMES NOUS ?</h1>
	<p>Nous sommes, ROMDHANI Ryan, LASLAH Samy et BOUCCEREDJ Sami. Nous sommes des étudiants en troisième années de licence informatique à l'univérsite de Cergy-Pontoise.</p>



	<div class="filmrecherche d-flex flex-wrap justify-content-between">

		<div class="profile-card card mb-3">
			<div class="row g-0">
				<div class="col-md-4">
					<img class="profile-image" src="images/profilpictureryan.jpg" alt="Card image cap" />
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">LASLAH Samy</h5>
						<p class="card-text"><small class="text-muted">Contact :</small></p>
						<p class="card-text"><small class="text-muted">Mail : @gmail.com</small></p>

					</div>
				</div>
			</div>
		</div>

		<div class="profile-card card mb-3">
			<div class="row g-0">
				<div class="col-md-4">
					<img class="profile-image" src="images/profilpicturehocem.png" alt="Card image cap" />
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">BOUCCEREDJ Sami</h5>
						<p class="card-text"><small class="text-muted">Contact :</small></p>
						<p class="card-text"><small class="text-muted">Mail : @gmail.com</small></p>

					</div>
				</div>
			</div>
		</div>

		<div class="profile-card card mb-3">
			<div class="row g-0">
				<div class="col-md-4">
					<img class="profile-image" src="images/ryan.jpg" alt="Card image cap" />
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">ROMDHANI Ryan</h5>
						<p class="card-text"><small class="text-muted">Contact :</small></p>
						<p class="card-text"><small class="text-muted">Mail : @gmail.com</small></p>

					</div>
				</div>
			</div>
		</div>
	</div>


	<h1>POURQUOI CE SITE ?</h1>
	<p>Nous avons créé le site <strong>"SSR Food Cergy"</strong> pour un projet en troisième années d'informatique, à l'université de Cergy-Pontoise.</p>
	<p>Pour ce faire, nous avons mis en avant l’ensemble des éléments techniques de l’UE <strong>« Développement Web, Base de donées et Réseau »</strong> : HTML 5 / CSS 3 / PHP 7, dans le cadre d’une réalisation en trinôme.</p>
	<p>C’est pourquoi nous avons utilisé plusieurs, language informatique, pour arriver à notre but (<strong>PHP, HTML, CSS</strong>).</p>
	<p>Le projet est un petit site web orienté sur nôtre <strong>restaurant</strong>. Pour cela nous nous sommes appuyer sur plusieurs ressources disponibles en ligne comme l'api <strong>"TheMovieDataBase"</strong></p>

	<p>Nous souhaitons que notre site soit <strong>simple, divers et accessible à tous</strong>, donc pour cela plusieurs langues sont disponibles sur le site et vous pouvez aussi filtrer vos recherches de film ou série en consultant leurs différents genres .</p>

	<p>Notre mission pour l'avenir serait, de pouvoir installer des sessions d'utilisateurs, pour pouvoir recevoir des commentaires sur notre site ou bien que l'utilisateur puisse avoir un historique plus complet de toutes ces visites de films et séries.</p>

</div>

<?php
require_once 'include/footer.inc.php';
?>