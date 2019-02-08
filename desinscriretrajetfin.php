<?php
  header('Content-type: text/html; charset=UTF-8');
?>
<?php
  session_start();
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
      $req=$connection->query("SELECT ville.nom nom FROM ville, trajet WHERE ville.codePostal = trajet.codeVille AND trajet.identifiant = $idtraj");
      // peu importe
      $req->setFetchMode(PDO::FETCH_OBJ);
      // boucle pour afficher les données de la requête
      while($enregistrement = $req->fetch())
      {
          $letrajet = $enregistrement->nom;
      }
      echo"Desinscription au trajet ".$letrajet." confirme!"
    ?>
    <BR><BR>
    <a href="voirmesinscriptiontrajet.php">Retour</a>
  </body>
</html>
