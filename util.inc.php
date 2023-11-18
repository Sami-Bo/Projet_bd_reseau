<?php
//fonction pour compter le nombre refresh de la page
function hitPage($increment)
{
    // ALe chemin du fichier compteur
    $path = './include/compteur.txt';

    // Ouvre le fichier compteur et compte le nombre de refresh
    $file  = fopen($path, 'r');
    $count = fgets($file, 1000);
    fclose($file);

    // Met a jour le nombre de compte
    $count = abs(intval($count)) + $increment;

    // Ouvre compteur.txt pour changer le nouveau nombre de clique.
    $file = fopen($path, 'w');
    fwrite($file, $count);
    fclose($file);
    return $count;
}

function afficheImage()
{
    $chem_img = "./images";
    $handle  = opendir($chem_img);
    while ($file = readdir($handle)) {
        if (preg_match("!(\.jpg|\.jpeg|\.gif|\.bmp|\.png)$!i", $file)) {
            $listef[] = $file;
        }
    }
    $random_img = rand(0, count($listef) - 1);
    sort($listef);


    //cette variable permet la non répétition de toute ces balises .
    $balise_image_random = "    <aside>
        <figure>
        <img class=\"imgpetit\" src=\"" . $chem_img . "/" . $listef[$random_img] . "\" alt=\"" . $listef[$random_img] . "\" />";
    
        switch ($random_img) {
        case 0:
            echo $balise_image_random . "
        <figcaption>brothers.png</figcaption>
    </figure>
    </aside>";
            break;
        case 1:
            echo $balise_image_random . "
        <figcaption>gas_station.jpg</figcaption>
    </figure>
    </aside>";
            break;
        case 2:
            echo $balise_image_random . " 
        <figcaption>nebuleuse_vert.jpg</figcaption>
    </figure>
    </aside>";
            break;
        case 3:
            echo $balise_image_random . " 
        <figcaption>samourai.jpg</figcaption>
    </figure>
    </aside>";
            break;
        case 4:
            echo $balise_image_random . "   
        <figcaption>sieg_jager.jpg</figcaption>
    </figure>
    </aside>";
            break;
        default:
            echo "Pas d'image.";
    }
    //On ferme le dossier
    closedir($handle);
}

function dateDuJour($lang)
{
    $lang;
    $date1 = date('Y-m-d');
    if ($lang == 'en') {
        setlocale(LC_ALL, 'fr_FR.UTF-8');
        return date("l, F j, Y");
    } elseif ($lang == 'fr') {
        setlocale(LC_ALL, "French");
        return  strftime("%A %d %B %G", strtotime($date1));
    } else {
        echo "La langue n'a pas été choisis";
    }
}

function get_navigateur()
{
    return $_SERVER['HTTP_USER_AGENT'];
}
?>