<?php
    header('Content-type: text/html; charset=UTF-8');
    require_once('connexion.php');
    if(isset($_SESSION['verif']))
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
            header("Location: afficherlogin.php");
          }
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
    $stmt = 'INSERT INTO salarie (identifiant,nom,prenom,mdp,numAdresse,voieAdresse,email,telephone,preferences,ville) VALUES ("'.$idSalarie.'","'.$nomSalarie.'","'.$prenomSalarie.'","'.$mdpSalarie.'",'.$numeroRue.',"'.$nomRue.'","'.$mailSalarie.'","'.$choixNum.'","'.$choixType.'",'.$codeVille->codePostal.')';
    try
    {
        $connection->exec($stmt);
        echo "<h1> Salarié ajouté </h1>";
    }
    catch (Exception $e) 
    {
        echo "<h1>ajout impossible : </h1>", $e->getMessage();
    }   
?>

<a href ="accueiladmin.php"> retour</a>