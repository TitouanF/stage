<?php
     session_start();
     //Vérifie si l'utilisateur est connecté avant de montrer la page
     if (!issset($_POST['id']))
     {


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
    }
    else
    {
        header("Location: suppressionSalarie.php");
    }
    $id = $_POST['id'];
    require_once('connexion.php');
    $requete = "SELECT * from trajet where idSalarie ='".$id."'";
    $resultat = $connection->query($requete);
    while($enregistrement = $resultat->fetch())
    {
        $idTrajet = $enregistrement['identifiant'];
        $requete2 = "delete from inscription where idTrajet ='".$idTrajet."'";
        $connection->exec($requete2);
        $requete3 = "delete from etapes where idTrajet ='".$idTrajet."'";
        $connection->exec($requete3);
        $requete4 = "delete from trajet where identifiant ='".$idTrajet."'";
        $connection->exec($requete4);
    }
    $requete5 = "delete from salarie where identifiant ='".$id."'";
    $connection->exec($requete5);
?>