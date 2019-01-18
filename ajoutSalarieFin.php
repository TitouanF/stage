<?php
    require_once('connexion.php');
    $idSalarie = $_POST['idSalarie'];
    $nomSalarie = $_POST['nomSalarie'];
    $prenomSalarie = $_POST['prenomSalarie'];
    $mdpSalarie = $_POST['mdpSalarie'];
    $numeroRue = $_POST['numeroRue'];
    $nomRue = $_POST['nomRue'];
    $mailSalarie = $_POST['mailSalarie'];
    $numeroSalarie = $_POST['numeroSalarie'];
    $choixType = $_POST['choixType'];
    $choixNum = $_POST['numeroSalarie'];
    $choixVille = $_POST['choixVille'];
    $resultat = $connection->query("select codePostal from ville where nom = '".$choixVille."'");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $codeVille = $resultat->fetch();
    $stmt = 'INSERT INTO salarie (identifiant,nom,prenom,mdp,numAdresse,voieAdresse,email,telephone,preferences,ville) VALUES ("'.$idSalarie.'","'.$nomSalarie.'","'.$prenomSalarie.'","'.$mdpSalarie.'",'.$numeroRue.',"'.$nomRue.'","'.$mailSalarie.'",'.$choixNum.',"'.$choixType.'",'.$codeVille->codePostal.')';
    try
    {
        $connection->exec($stmt);
    }
    catch (Exception $e) 
    {
        echo "ajout impossible : ", $e->getMessage();
    }   
?>
<h1> Salarié ajouté </h1>
<a href ="accueiladmin.php"> retour</a>