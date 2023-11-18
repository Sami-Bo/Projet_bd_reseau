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

<legend>Login </legend>
<form action="loginprocess.php" method="POST"><br><br>
    Username:<input type="text" required="" name="uname"><br><br>
    Password:<input type="text" required="" name="upassword"><br><br>
    <input type="submit" value="Login" name="sub">
    <br>
    <?php 
        if(isset($_REQUEST["err"]))
            $msg="Invalid username or Password";
    ?>
    <p style="color:red;">
        <?php 
            if(isset($msg))
            {
                echo $msg;
            }
        ?>  
    </p>
</form>

<?php
    require_once 'include/footer.inc.php';
?>