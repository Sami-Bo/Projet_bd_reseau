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
<fieldset>
<legend>Login </legend>
<form action="inscription.php" method="POST"><br><br>
Prénom:<input type="text" required="" name="prenom"><br><br>
Nom:<input type="text" required="" name="nom"><br><br>
Mail:<input type="text" required="" name="mail"><br><br>
Numero de telephone:<input type="text" required="" name="utel"><br><br>
Adresse:<input type="text" required="" name="adresse"><br><br>
Nouveau mot de passe:<input type="text" required="" name="mdp"><br><br>
<input type="submit" value="Login" name="sub2">
<br>
<?php 

if(isset($_REQUEST['sub2']))
{
session_start ();
include("config.php");
$prenom = $_REQUEST['prenom'];
$nom = $_REQUEST['nom'];
$mail = $_REQUEST['mail'];
$mdp = $_REQUEST['mdp'];
$adresse = $_REQUEST['adresse'];
$utel = $_REQUEST['utel'];
$mdp = password_hash($mdp, PASSWORD_DEFAULT);
$res = pg_query($dbconn,"INSERT INTO \"Client\" VALUES ('0000030000','$prenom','$nom','$mail','$utel','$adresse','1','$mdp')");
pg_free_result($res);
pg_close($dbconn);
}
?>

</p>

</form>

<?php
require_once 'include/footer.inc.php';
?>