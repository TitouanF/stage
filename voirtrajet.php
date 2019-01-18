<?php
  session_start();
  if ($_SESSION['verif'] == "admin")
  {
    header("Location: accueiladmin.php");
  }
  elseif ($_SESSION['verif'] == "salarie")
  {
    
  }
  else
  {
    header("Location: afficherlogin.php");
  }
?>

<html>
  <head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Voir Trajet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        table, td, th {
        border: 1px solid black;
        }

        table {
        border-collapse: collapse;
        width: 50%;
        }

        th {
        height: 50px;
        }
        th, td {
        padding: 15px;
        text-align: left;
        }
    </style>
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
    <div style="padding: 5px">
        Liste des Trajets :
        <br>
        <table>
            <tr>
                <th>Ville</th>
                <th>Date</th>
                <th>Heure</th>
            </tr>
            <?php
            require_once('connexion.php');

            $req=$connection->query("SELECT trajet.identifiant id, trajet.dateTrajet datet, trajet.heure heure, trajet.codeVille codev, ville.nom nom From trajet, ville Where ville.codePostal = trajet.codeVille");

            $req->setFetchMode(PDO::FETCH_OBJ);

            while($enregistrement = $req->fetch())
            {

                echo("<tr><td>".$enregistrement->nom."</td>");
                echo("<td>".$enregistrement->datet."</td>");
                echo("<td>".$enregistrement->heure."</td></tr>");
            }
            ?>
        </table>
    </div>
  </body>
</html>
