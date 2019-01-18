<?php
  //Permet de ne pas afficher les erreurs au client quand il rentre des identifiants non valide
  ini_set("display_errors",0);error_reporting(0);
  session_start();
  $_SESSION['idSalarie'] = $_POST[idSalarie];
?>
<html>
  <head>
  </head>
  <body>
    <?php
      // référence au fichier connexion, donc $connection dans ce fichier
      require_once('connexion.php');
      // Envoi de la requête vers MySQL
      $req = $connection->query("SELECT * FROM salarie WHERE salarie.identifiant = 'admin'");
      // peu importe
      $req->setFetchMode(PDO::FETCH_OBJ);
      // boucle pour afficher les données de la requête
      while($enregistrement = $req->fetch())
      {
        // Analyse du mdp et du matricule de l'entrée fournie avec la table client
        if ($_POST[idSalarie] == $enregistrement->identifiant && $_POST[Mdp] == $enregistrement->mdp)
        {
            $_SESSION['verif'] = "admin";
            header("Location: accueiladmin.php");
        }
      }
    ?>
    <div class="idinvalide">Mot de passe non valide</div>
    <a href="deconnection.php">Retour</a>
  </body>
</html>
