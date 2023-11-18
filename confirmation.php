<?php
$config = json_decode(file_get_contents("./include/config.json"));
 if (!isset($_POST["page"]) || empty($_POST["page"])) {
    $_POST["page"] = 1;
  }
$titre = 'Série - Page '.$_POST["page"];
$titreh1 = 'SSR Food Cergy - Commander';
$datem = 'November. 4, 2022';
$description = 'Commander';
$td = '';
require_once 'include/header.inc.php';
?>

<?php  include("config.php"); ?>




<div id="details">
  <p> Merci pour votre commande. Cliquer sur le bouton ci-dessous pour afficher les détails.</p>
  <p id="details2"></p>
</div>

<?php
  include("config.php"); 
  $sql =<<<EOF
      SELECT id_menu, nom_menu, composition_menu, prix_menu FROM "Menu";
  EOF;
  $ret = pg_query($dbconn, $sql);
  if(!$ret) {
      echo pg_last_error($dbconn);
      exit;
  } 
  while($row = pg_fetch_row($ret)) {
    echo "<p>" .$_POST[$row[1]]. " " .$row[1]."</p>";
  }
?>




<?php
require_once 'include/footer.inc.php';
?>