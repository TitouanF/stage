<?php
  session_start()
?>
<html>
  <head>
      <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
      <title>Connexion</title>
      <link rel=stylesheet type="text/css" href="style.css"/>
    </head>
  <body>
      <?php
        //Vérifie si l'utilisateur est connecté avant de montrer la page
        if ($_SESSION['verif'] == "admin")
        {

        }
        elseif ($_SESSION['verif'] == "salarie")
        {
          header("Location: accueilsalarie.php");
        }
        else
        {
          header("Location: afficherlogin.php");
        }
      ?>
  ADMIN
  </body>
</html>