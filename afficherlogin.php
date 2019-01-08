<?php

?>

<html>
  <head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Connexion</title>
    <link rel=stylesheet type="text/css" href="style.css"/>
  </head>
  <body>
    <div class="duFond1">
      <form action="veriflogin.php" method="post">
        Identifiant : <select name="idSalarie">
          <?php
          require_once('connexion.php');

          $req=$connection->query("SELECT * FROM salarie WHERE identifiant <> 'admin'");

          $req->setFetchMode(PDO::FETCH_OBJ);

          while($enregistrement = $req->fetch())
          {
            echo("<option>".$enregistrement->identifiant."</option>");
          }
          ?>
        </select><br>
        Mot de Passe : <input type="password" name="Mdp" required><BR></BR>
        <input type="submit" value="Se Connecter" >
        <input type="reset" value="Annuler">
      </form>
    </div>
    <div>
        <a href="afficheradmin.html">Administrateur ?</a>
    </div>
  </body>
</html>
