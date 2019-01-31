<?php
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