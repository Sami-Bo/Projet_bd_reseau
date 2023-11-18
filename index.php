<?php
//Plusieur déclaration de variable
$config = json_decode(file_get_contents("./include/config.json"));
$titre = 'Accueil - Restautant';
$titreh1 = 'SSR Food Cergy';
$datem = 'November. 4, 2022';
$description = 'SSR Food Cergy';
$td = 'accueil';
//condition pour éviter le warning "Langue" is undefined et mettre la langue francaise en langue par défaut
if (!isset($_COOKIE["Langue"]) || empty($_COOKIE["Langue"])) {
    $_COOKIE["Langue"] = "fr-FR";
}
//appel du header et de quelque fonction utile comme la date ect...
require_once 'include/header.inc.php';
require 'include/util.inc.php';
?>

<main>
    <h1>Bienvenue chez SSR FOOD</h1>
    <div class="card-deck">
        <div class="card">
            <a class="nav-link" href="compte.php"><img class="card-img-top" src="images/profilpictureryan.jpg" alt="Card image cap"></a>
            <div class="card-body">
                <h5 class="card-title">Créer un compte</h5>
                <p class="card-text">Créer un compte afin de profiter d'offres exclusives.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.php">Inscription</a>
                    </li>        
                </ul>
            </div>
        </div>
        <div class="card">
            <a class="nav-link" href="commander.php"><img class="card-img-top" src="images/profilpictureryan.jpg" alt="Card image cap"></a>
            <div class="card-body">
                <h5 class="card-title">Passer une commande</h5>
                <p class="card-text">Recevez votre commande chez vous ou récupérez là sur place.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="commander.php">Commander</a>
                    </li>      
                </ul> 
            </div>
        </div>
        <div class="card">
            <a class="nav-link" href="carte.php"><img class="card-img-top" src="images/profilpictureryan.jpg" alt="Card image cap"></a>
            <div class="card-body">
                <h5 class="card-title">Trouver un restaurant</h5>
                <p class="card-text">Lancez une recherche afin de découvrir les restaurants près de chez vous.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="carte.php">Rechercher</a>
                    </li>      
                </ul>            
            </div>
        </div>
    </div>           
</main>

<?php
require_once 'include/footer.inc.php';
?>
