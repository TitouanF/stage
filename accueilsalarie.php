<?php
  session_start()
?>
<html>
  <body>
    <head>
        <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
        <title>Connexion</title>
        <link rel=stylesheet type="text/css" href="style.css"/>
    </head>
      <?php
        //Vérifie si l'utilisateur est connecté avant de montrer la page
        if ($_SESSION['verif'] == "salarie")
        {

        }
        elseif ($_SESSION['verif'] == "admin")
        {
          header("Location: pageadmin.php");
        }
        else
        {
          header("Location: afficherlogin.php");
        }
      ?>
  <button>Proposer trajet</button>
  <button>Voir Trajet</button>
  <button>Voir Inscription</button>
  </body>
</html>