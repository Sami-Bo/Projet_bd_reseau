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
	echo "<div class='container'>
  <h1>Commander</h1>
  <div class='row'>";
  while($row = pg_fetch_row($ret)) {
    echo" 
    <div class='col-sm-6'>
      <div class='card'>
        <img class='card-img-top' src='images_menu/$row[0].png' alt='Card image cap'>
        <div class='card-body'>
          <h5 class='card-title'>Menu $row[1]</h5>
          <p class='card-text'>$row[2]</p>
          <ul class='navbar-nav'>
            <li class='nav-item'>
              <button onclick=\"choose3('$row[1]','$row[3]')\" class='btn btn-primary'>Choisir</a>
            </li>      
          </ul> 
        </div>
        <div class='card-footer'>
          <small class='text-muted'>$row[3]	&#8364;</small>
        </div>
      </div>
    </div>\n\n";
  }
	echo "</div>
  </div>";
  $ret = pg_query($dbconn, $sql);
  if(!$ret) {
      echo pg_last_error($dbconn);
      exit;
  } 
  echo 
  "<form id='formchoice' method='post' action='confirmation.php'>
    <legend>MES CHOIX :</legend>";
    while($row = pg_fetch_row($ret)) {
      echo
        "<div>
        <input type='number' name='$row[1]' value='0' />
        <label for='coding'>Menu $row[1]</label>
        </div>";
  }
  echo"<div>
    <input type='submit' value='Valider' />
    </div>
  </form>";
  //echo "Operation done successfully\n";
  pg_close($dbconn);
?>

<!-- Sidebar -->
<div class="ryan">
  <button class="btn btn-primary" onclick="w3_open_or_close()">☰</button>
  <div id="fixed" style="display:block">
    <table id="choice">
      <tr>
        <th>Mes choix</th>
        <th>Prix (en &#8364;)</th>
        <th>Quantite</th>
        <th>Prix total (en &#8364;)</th>
      </tr>
    </table>
  </div>
  <!--<a href="confirmation.php" class="btn btn-primary" onclick="confirmer2()">COMMANDER</a>-->
  <!--<button class="btn btn-primary" onclick="ajoutCmdBd()">COMMANDER</button>-->
  <!--<button class="btn btn-primary" onclick="confirmer3()">COMMANDER</button>-->
</div>

<?php
echo "yo";
/*<div>
    <input type="checkbox" id="coding" name="interest" value="coding">
    <label for="coding">Développement</label>
  </div>
  <div>
    <input type="checkbox" id="music" name="interest" value="music">
    <label for="music">Musique</label>
  </div>*/
?>

<script>
function w3_open_or_close() {
  if (document.getElementById("fixed").style.display == "block")
    document.getElementById("fixed").style.display = "none";
  else
    document.getElementById("fixed").style.display = "block"
}
</script>

    <?php
require_once 'include/footer.inc.php';
?>
