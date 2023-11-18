<?php
$config = json_decode(file_get_contents("./include/config.json"));
$titre = 'Statistique';
$titreh1 = 'Oscar dictionary - Statistique';
$datem = 'Mar. 30, 2021';
$description = 'Page regroupant les films ou séries les plus consultés';
$td = '';
require_once 'include/header.inc.php';
require 'include/util.inc.php';
include 'include/functions.inc.php';
?>
<div class="container">
   <h1>Statistiques</h1>
   <p>Cette page regroupe différentes statistiques, des films et série consultés sur le site en fonction de leur nombres de visite.</p>
   <div class="row">
      <div class="col-6">

         <h2>Statistiques Séries</h2>
         <img src="graphSerie.php" alt="Histogramme des séries en fonction du nombre des visites" />
      </div>
      <div class="col-6">
         <h2>Statistiques Films</h2>
         <img src="graphFilm.php" alt="Histogramme des films en fonction du nombre des visites" />
      </div>
   </div>
   <div class="row">
      <div class="col-12">
      <h2>Nombre de visite total du site</h2>
      
      <?php echo hitPage(0)." Visites"; //ajout du parametre dans hitpage pour éviter d'incrémenter deux fois car la fonction est déja appelé dans le header.inc.php?>
      </div>
   </div>
</div>
<?php
require_once 'include/footer.inc.php';
