<?php
  session_start()
?>
<html>
  <head>
      <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
      <title>Connexion</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
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
    echo"Connecte en tant que : ". $_SESSION['leprenom'] ." ". $_SESSION['lenom'] ."";
    echo"<BR><BR>";
  ?>
  <button>Proposer trajet</button>
  <a href="voirtrajet.php"><button>Voir Trajet</button></a>
  <button>Voir Inscription</button>
  <BR><BR>
  <a href="deconnection.php"><button>Deconnexion</button></a>
  </body>
</html>