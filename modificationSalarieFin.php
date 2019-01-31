<?php
    session_start();
    require_once('connexion.php');
    $idSalarie =  $_SESSION['idSalarie'];
    $numeroRue = $_POST['numeroRue'];
    $nomRue = $_POST['nomRue'];
    $mailSalarie = $_POST['mailSalarie'];
    $numeroSalarie = $_POST['numeroSalarie'];
    $choixType = $_POST['choixType'];
    $choixVille = $_POST['choixVille'];
    $stmt = "update salarie 
            set numAdresse = '".$numeroRue."',
            voieAdresse= '".$nomRue."',
            email ='".$mailSalarie."',
            telephone='".$numeroSalarie."',
            preferences='".$choixType."',
            ville = '".$choixVille."'
            where identifiant = '".$idSalarie."'";
    try
    {
        $connection->exec($stmt);
    }
    catch (Exception $e) 
    {
        echo "ajout impossible : ", $e->getMessage();
    }   
?>
<h1> Modification(s) effectuée(s) </h1>
<a href ="accueiladmin.php">Retour</a>