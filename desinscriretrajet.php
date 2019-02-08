<?php
  header('Content-type: text/html; charset=UTF-8');
?>
<?php
  session_start();
  $idsal = $_SESSION['idSalarie'];
  $idtraj = $_GET['idtrajet'];
?>
<html>
  <head>
  </head>
  <body>
  <?php
        //Vérifie si l'utilisateur est connecté avant de montrer la page
        if ($_SESSION['verif'] == "salarie")
        {

        }
        elseif ($_SESSION['verif'] == "admin")
        {
            header("Location: accueiladmin.php");
        }
        else
        {
            header("Location: afficherlogin.php");
        }
    ?>
    <?php
      // référence au fichier connexion, donc $connection dans ce fichier
      require_once('connexion.php');
      // Envoi de la requête vers MySQL
      $req=$connection->query("DELETE FROM inscription WHERE idSalarie = '$idsal' AND idTrajet = '$idtraj'");
      $req=$connection->query("UPDATE trajet SET nbmax = nbmax + 1 WHERE trajet.identifiant = '$idtraj'");
      header("Location: desinscriretrajetfin.php?idtrajet=".$idtraj."");
    ?>
  </body>
</html>
