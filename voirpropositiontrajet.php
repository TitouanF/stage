<?php
  session_start();
  $idSalarie = $_SESSION['idSalarie'];
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
        Les Propositions :
        <br>
            <?php
            //echo "".$idSalarie."";
            require_once('connexion.php');
            
            $req=$connection->query("SELECT trajet.identifiant idt, ville.nom nom, trajet.dateTrajet datet, trajet.heure heure, trajet.typeTrajet typet, trajet.frequence FROM ville, trajet WHERE ville.codePostal = trajet.codeVille AND (trajet.idSalarie <> '$idSalarie' OR trajet.idSalarie IS NULL) AND ville.nom not in( SELECT ville.nom FROM ville, trajet, inscription WHERE ville.codePostal = trajet.codeVille AND trajet.identifiant = inscription.idTrajet AND inscription.idSalarie = '$idSalarie' )");

            $req->setFetchMode(PDO::FETCH_OBJ);

            $nbr=$req->rowCount();
            if($nbr > 0)
            {
                echo("<table>");
                echo("<tr>");
                echo("<th>Ville</th>");
                echo("<th>Date</th>");
                echo("<th>Heure</th>");
                echo("<th>Type</th>");
                echo("<th>Frequence</th>");
                echo("<th colspan='2'>Action</th>");
                echo("</tr>");
                while($enregistrement = $req->fetch())
                {
                    echo("<tr><td>".$enregistrement->nom."</td>");
                    echo("<td>".$enregistrement->datet."</td>");
                    echo("<td>".$enregistrement->heure."</td>");
                    echo("<td>".$enregistrement->typet."</td>");
                    echo("<td>".$enregistrement->frequence."</td>");
                    echo("<td><button>Id trajet : ".$enregistrement->idt."</button></td>");
                    echo("<td><a href='inscriptiontrajet.php?idtrajet=".$enregistrement->idt."'><button>S'inscrire</button></a></td></tr>");
                }
            }
            elseif($nbr == 0)
            {
                echo("Auncun trajet n'est proposé :/");
            }
            ?>
        </table>
        <a href="accueilsalarie.php"><button>Retour</button></a>
    </div>
  </body>
</html>
