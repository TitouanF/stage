<?php
  header('Content-type: text/html; charset=UTF-8');
?>
<?php
if ($_SESSION['verif'] == "admin")
    {           
    }
elseif ($_SESSION['verif'] == "salarie")
    {
    }
else
    {
        header("Location: afficherlogin.php");
    }
?>
<h1> suppression réussie </h1>
<a href ="accueilSalarie.php"> </a>
