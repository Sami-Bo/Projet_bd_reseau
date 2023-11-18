<?php
$config = json_decode(file_get_contents("./include/config.json"));
if (!isset($_POST["page"]) || empty($_POST["page"])) {
  $_POST["page"] = 1;
}
$titre = 'Produits - Page ' . $_POST["page"];
$titreh1 = 'SSR Food Cergy - Produits';
$datem = 'November. 4, 2022';
$description = 'Produits';
$td = '';

require_once 'include/header.inc.php';
?>
<main>
<div class="container">
<h1>Produits</h1>
	<h2 style="color:red;">VENEZ ADMIRER CES DELICIEUX PRODUITS QUE VOUS NE POURREZ JAMAIS ACHETER</h2>
<?php
        $host        = "host = ";
        $port        = "port = ";
        $dbname      = "dbname = ";
        $credentials = "user = ";

        $db = pg_connect( "$host $port $dbname $credentials"  );
        if(!$db) {
            echo "Error : Unable to open database\n";
        } /*else {
            echo "Opened database successfully\n";
        }*/

        $sql =<<<EOF
            SELECT nom_produit, id_produit FROM "Produit";
        EOF;

        $ret = pg_query($db, $sql);
        if(!$ret) {
            echo pg_last_error($db);
            exit;
        } 
		echo "<div class='card-deck'>";

        while($row = pg_fetch_row($ret)) {
            echo "<div class='card' style='width: 18rem;'>
			<img class='card-img-top' src='images_produits/$row[1].png' alt='Card image cap'>
			<div class='card-body'>
			  <h5 class='card-title'>$row[0]</h5>
			  <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			  <a href='' class='btn btn-primary'>Go somewhere</a>
			</div>
		  </div>\n\n";
        }
		echo "</div>";
        //echo "Operation done successfully\n";
        pg_close($db);
    ?>
</main>
<?php
require_once 'include/footer.inc.php';
?>
