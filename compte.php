<?php
$config = json_decode(file_get_contents("./include/config.json"));
 if (!isset($_POST["page"]) || empty($_POST["page"])) {
    $_POST["page"] = 1;
  }
$titre = 'Série - Page '.$_POST["page"];
$titreh1 = 'SSR Food Cergy - Inscription';
$datem = 'November. 4, 2022';
$description = 'Inscription';
$td = '';
require_once 'include/header.inc.php';


?>
<div class="container">
    <h1>Inscription</h1>

    <?php
        $host        = "host = postgresql-projetbdreseau.alwaysdata.net";
        $port        = "port = 5432";
        $dbname      = "dbname = projetbdreseau_base";
        $credentials = "user = projetbdreseau password=19/08/2002Rr";

        $db = pg_connect( "$host $port $dbname $credentials"  );
        if(!$db) {
            echo "Error : Unable to open database\n";
        } /*else {
            echo "Opened database successfully\n";
        }*/

        $sql =<<<EOF
            SELECT nom_ingredient FROM "Stock" NATURAL JOIN "Ingredient";
        EOF;

        $ret = pg_query($db, $sql);
        if(!$ret) {
            echo pg_last_error($db);
            exit;
        } 
        while($row = pg_fetch_row($ret)) {
            echo "Ingredient = ". $row[0] . "\n\n";
        }
        //echo "Operation done successfully\n";
        pg_close($db);
    ?>

    <?php
require_once 'include/footer.inc.php';
?>
