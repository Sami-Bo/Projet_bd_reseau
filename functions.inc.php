<?php
/*Mes fonctions :*/

function createCsv($jsonData, $movieOrSerie, $path)
{
   $file = fopen($path, 'a');
   // Définition des données
   //data = [titre,date,id,ip]
   if ($movieOrSerie == "serie") {
      $data = array($jsonData->name, date("d/m/Y H:i:s"), $jsonData->id, $_SERVER["REMOTE_ADDR"], 1);
   } else {
      $data = array($jsonData->title, date("d/m/Y H:i:s"), $jsonData->id, $_SERVER["REMOTE_ADDR"], 1);
   }

   // sauvegarder chaque passaage dans la boucle dans le fichier
   fputcsv($file, $data, ";");
   // Ferme le fichier
   fclose($file);
}
function readCsv($path)
{
   $dataArray = [];
   if (($handle = fopen($path, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
         array_push($dataArray, $data);
      }
      fclose($handle);
      return $dataArray;
   }
}
function updateCsv($jsonData, $movieOrSerie, $path)
{
   $movieFoundKey = -1;
   $csvData = readCsv($path);
   $i = 0;
   $lineData = count($csvData);
   while ($i < $lineData && $movieFoundKey === -1) {
      if ($csvData[$i] && ($csvData[$i][2] == $jsonData->id)) {
         $movieFoundKey = $i;
      }
      $i++;
   }

   if ($movieFoundKey !==  -1) {
      $intVisit = intval($csvData[$movieFoundKey][4]);
      $csvData[$movieFoundKey][4] = strval(++$intVisit);
      $file = fopen($path, 'w');
      foreach ($csvData as $value) {
         fputcsv($file, $value, ";");
      }
      // Ferme le fichier
      fclose($file);
   } else {
      createCsv($jsonData, $movieOrSerie, $path);
   }
}
function genreList($type, $title, $serieFilm)
{
   $config = json_decode(file_get_contents("./include/config.json"));
   echo '
      <div class="row">
      
         <div class="col-6">
            <form action="' . $serieFilm . '.php" method="get">
               <label for="genre">Genres</label>
               <select id="genre" name="genre">
               ';

   if (!isset($_COOKIE["Langue"]) || empty($_COOKIE["Langue"])) {
      $_COOKIE["Langue"] = "fr-FR";
   }

   $genrelist = json_decode(file_get_contents($config->link_api . "genre/" . $type . "/list?api_key=" . $config->key_api . "&language=" . $_COOKIE["Langue"]));
   $genrelist = $genrelist->genres;
   foreach ($genrelist as $value) {
      echo "<option value=\"" . $value->id . "\">" . replaceEt($value->name). "</option>";
   }
?>
   </select>
   <input type="submit" value="Rechercher" />
   </form>
   </div>
   <div class="col-6">

      <?php
      echo ' <form action="' . $serieFilm . '.php" method="get">
      <label for="search-movie">Votre ' . $serieFilm . ' à rechercher &#8594;</label>
      <input name="search" id="search-movie" type="text" required="required" placeholder="Tapez votre ' . $serieFilm . ' ici..." />
      <input type="submit" value="Rechercher" />
   </form>';
      ?>
   </div>
   </div>


<?php

   if (!isset($_GET["genre"]) && !isset($_GET["search"])) {
      echo "<div class=\"mt-5\" id='topFilm'>
      <h2>Top 20 " . $serieFilm . "s du moments</h2>";

      $obj = json_decode(file_get_contents($config->link_api . $type . "/popular?api_key=" . $config->key_api . "&page=1&language=" . $_COOKIE["Langue"]));

      $obj = $obj->results;
      echo "<div class=\"filmrecherche d-flex flex-wrap justify-content-between\">";
      foreach ($obj as $value) {
         if ($value->backdrop_path) {
            $imageSrc = "https://image.tmdb.org/t/p/original" . $value->poster_path;
         } else {
            $imageSrc = "./images/no-image.jpg";
         }
         echo " <div class=\"card my-4 mx-1\">
                  <a href=\"data_" . $serieFilm . ".php?id=" . $value->id . "\">
                     <img class=\"card-img-top\" src=\"" . $imageSrc . "\" alt=\"Card image cap\" />
                  </a>
                  <div class=\"card-body d-flex justify-content-center align-items-center\">";

         echo "<h6 class=\"card-text\">" . replaceEt($value->$title) . "</h6>
                  </div>
               </div>";
      }
      echo "</div>";
      echo "</div></div>";
   }
   if (isset($_GET["genre"]) && !empty($_GET["genre"])) {
      $obj = json_decode(file_get_contents($config->link_api . "discover/" . $type . "?api_key=" . $config->key_api . "&language=" . $_COOKIE["Langue"] . "&sort_by=popularity.desc&page=" . $_POST["page"] . "&with_genres=" . $_GET["genre"] . "&with_watch_monetization_types=flatrate"));
      echo "<div class=\"col-12\">";
      echo "<div class='mt-5 mb-1 d-flex justify-content-center'>";
      if ($obj->total_pages != null) {
         echo '<form action="' . $serieFilm . '.php?genre=' . $_GET["genre"] . '" method="post">';
         echo '<div class="input-group">
                  <select class="form-select" name="page" id="pageTop" aria-label="Example select with button addon">
                  <option disabled selected>Choisir la page</option>';
         for ($i = 1; $i <= $obj->total_pages; $i++) {
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
         }
         echo '
                  </select>
                  <button class="btn btn-outline-secondary" type="submit">Go</button>
               </div>
               <label class="d-block text-center" for="pageTop">Page n°' . $_POST["page"] . '</label>';
         echo '</form>';
      }
      echo "</div>";

      displayMovies($title, $serieFilm, $obj);
   }
}


function searchMovieSerie($type, $title, $serieFilm)
{
   $config = json_decode(file_get_contents("./include/config.json"));
   $config->key_api = 'b576240539e694094999feced24912ca';

   if (isset($_GET["search"]) && !empty($_GET["search"])) {
      $query = $_GET["search"];

      $query = str_replace(' ', '%2B', $query); //Au cas ou l'utilisateur met un espace dans le formulaire cela le remplace avec un '+' pour avoir une url valide
      echo "<div class=\"col-12\">";
      $obj = json_decode(file_get_contents($config->link_api . "search/" . $type . "?api_key=" . $config->key_api  . "&query=" . $query . "&language=" . $_COOKIE["Langue"] . "&page=" . $_POST["page"]));
      $objr = $obj->results;

      echo "<div class=\"mt-5 mb-1 d-flex justify-content-center\">";
      if ($obj->total_pages != null) {
         echo '<form action="' . $serieFilm . '.php?&search=' . $query . '" method="post">';
         echo '<div class="input-group">
                     <select class="form-select" name="page" id="pageTop" aria-label="Example select with button addon">
                     <option disabled selected>Choisir la page</option>';
         for ($i = 1; $i <= $obj->total_pages; $i++) {
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
         }
         echo '
                     </select>
                     <button class="btn btn-outline-secondary" type="submit">Go</button>
                  </div>
                  <label class="d-block text-center" for="pageTop">Page n°' . $_POST["page"] . '</label>';
         echo '</form>';
      }

      echo "</div>";

      if ($objr == null) {
         echo "
          <div class=\"alert alert-danger\">
          <p>Votre recherche pour : <strong>" . $_GET["search"] . "</strong>, n'a donné aucun résultat ....</p>
          <strong>Suggestions:</strong>
          <ul>
          <li>Assurez vous que tous les mots sont épelés correctement.</li>
          <li>Essayez différents mots-clés.</li>
          <li>Essayez des mots clés plus généraux.</li>
          </ul>
          </div>";
      }
      displayMovies($title, $serieFilm, $obj);
   }
}


function displayMovies($title, $serieFilm, $obj)
{
   $objr = $obj->results;
   echo "<div class=\"filmrecherche d-flex flex-wrap justify-content-between\">";
   if ($serieFilm == "serie") {
      $searchMovieSerie = "serie";
   } else {
      $searchMovieSerie = "film";
   }
   foreach ($objr as $value) {

      if ($value->backdrop_path) {
         $imageSrc = "https://image.tmdb.org/t/p/original" . $value->poster_path;
      } else {
         $imageSrc = "./images/no-image.jpg";
      }
      echo "<div class=\"card my-4 mx-1\">
               <a href=\"data_" . $searchMovieSerie . ".php?id=" . $value->id . "\">
                  <img class=\"card-img-top\" src=\"" . $imageSrc . "\" alt=\"Card image cap\" />
               </a>
               <div class=\"card-body d-flex justify-content-center align-items-center\">";

      echo "<h6 class=\"card-text\">" . $value->$title . "</h6>
               </div>
         </div>";
   }
   echo "</div></div></div>";
}
//On fait ici une fonction replaceEt pour pouvoir changer les & avec des et pour avoir un xml valide
function replaceEt($stringEt){
   return $stringEt = str_replace('&', '&amp;', $stringEt);
}
