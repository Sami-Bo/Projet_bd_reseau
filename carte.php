<?php
$config = json_decode(file_get_contents("./include/config.json"));
 if (!isset($_POST["page"]) || empty($_POST["page"])) {
    $_POST["page"] = 1;
  }
$titre = 'Série - Page '.$_POST["page"];
$titreh1 = 'SSR Food Cergy - Rechercher';
$datem = 'November. 4, 2022';
$description = 'Rechercher';
$td = '';
require_once 'include/header.inc.php';


?>
<div class="container">
    <h1>Rechercher</h1>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/carte.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Carte de France</h5>
                <p class="card-text">Trouver nos restaurants grâce à notre carte interactive</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    <?php
require_once 'include/footer.inc.php';
?>
