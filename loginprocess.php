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
<?php
    session_start ();
    include("config.php"); 

    if(isset($_REQUEST['sub']))
    {   
        $a = $_REQUEST['uname'];
        $b = $_REQUEST['upassword'];
        $b = password_hash($b, PASSWORD_DEFAULT);

        $sql =<<<EOF
            SELECT * FROM "Client" WHERE mail_client='$a' AND mot_de_passe='$b';
        EOF;

        $res = pg_query($dbconn,$sql) or die("Cannot execute query: $a $b $query\n");
        $result = pg_fetch_row($res);
        if($result)
        {
            $_SESSION["login"]="1";
            header("location:index.php");
        }
        else 
        {
            header("location:login.php?err=1");
        }
        pg_free_result($res);
        pg_close($dbconn);
    }
?>
<?php
    require_once 'include/footer.inc.php';
?>