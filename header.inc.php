<?php

declare(strict_types=1);
if (isset($_POST["lang"]) && !empty($_POST["lang"])) {
  header("Refresh: 0");
  $tabLang = array(
    "Francais" => "fr-FR",
    "Anglais" => "en-US",
    "Chinois" => "zh",
    "Arabe" => "ar",
  );
  setcookie("Langue", $tabLang[$_POST["lang"]], time() + 365 * 24 * 3600, "/projet");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>

  <link rel="stylesheet" href="stylesnd.css" type="text/css" />
  <link rel="icon" type="image/png" href="images/logo_icon.png" />
  <meta charset="utf-8" />
  <meta name="language" content="FR" />
  <meta name="author" content="Ryan Romdhani" />
  <meta name="keywords" content="HTML, PHP, CSS, XHTML" />
  <meta name="description" content="<?php echo $description ?>" />
  <meta name="date" content=" <?php echo $datem ?>" />
  <title> <?php echo $titre ?></title>

  <script src = "./script.js" type = "text/javascript"></script>

</head>


<body>
  <header class="mb-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
          <div class="hover11 column">
            <img src="images/logo_large.png" alt="Logo du site dans le header" width="30" height="24" class="logo-head d-inline-block align-text-top" />
          </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <form method="post">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="./index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./produits.php">Produits</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./commander.php">Commander</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./statistique.php">Statistiques</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./a_propos.php">A propos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./inscription.php">Inscription</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./login.php">Connexion</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                  Langue
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <input name="lang" type="submit" class="dropdown-item" value="Francais" />
                  <input name="lang" type="submit" class="dropdown-item" value="Anglais" />
                  <input name="lang" type="submit" class="dropdown-item" value="Chinois" />
                  <input name="lang" type="submit" class="dropdown-item" value="Arabe" />
                </div>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </nav>
  </header>
  