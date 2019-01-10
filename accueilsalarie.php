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
          $idSalarie = $_SESSION['idSalarie'];
          require_once('connexion.php');
          $req=$connection->query("SELECT nom, prenom FROM salarie WHERE identifiant = '$idSalarie'");
          $req->setFetchMode(PDO::FETCH_OBJ);
          while($enregistrement = $req->fetch())
          {
            $_SESSION['lenom'] = $enregistrement->nom;
            $_SESSION['leprenom'] = $enregistrement->prenom;
          }
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
    echo"Connecté en tant que : ". $_SESSION['leprenom'] ." ". $_SESSION['lenom'] ."";
    echo"<BR><BR>";
  ?>
  <button>Proposer trajet</button>
  <button>Voir Trajet</button>
  <button>Voir Inscription</button>
  <BR><BR>
  <a href="deconnection.php"><button>Deconnexion</button></a>
  </body>
</html>