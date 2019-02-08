<?php
  header('Content-type: text/html; charset=UTF-8');
?>
<?php
  session_start();
  $idSalarie = $_SESSION['idSalarie'];
  $idTrajet = $_POST['idtraj'];

  //Vérifie si l'utilisateur est connecté avant de montrer la page
  if ($_SESSION['verif'] == "salarie" && isset($_POST['idtraj']))
  {
    require_once('connexion.php');
    //Suppression de toutes les inscriptions au trajet
    $req=$connection->query("DELETE FROM inscription WHERE idTrajet = '$idTrajet'");
    //Suppression de toutes les etapes du trajet
    $req=$connection->query("DELETE FROM etapes WHERE idTrajet = '$idTrajet'");
    //Suppression du trajet
    $req=$connection->query("DELETE FROM trajet WHERE identifiant = '$idTrajet'");
    
    echo("<html>");
    echo("<body>");
    echo("<h1>Trajet supprimmé</h1>");
    echo("<a href='voirmespropositiontrajet.php'><button type='button'>Retour</button></a>");
    echo("<body>");
    echo("<html>");
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