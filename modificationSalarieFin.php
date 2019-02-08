<?php
  header('Content-type: text/html; charset=UTF-8');
?>
<?php
    session_start();
    if(isset($_SESSION['verif']) && isset($_SESSION['idSalarie']) && isset($_POST['numeroRue']))
    {


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
    }
    else
    {
        header("Location: afficherlogin.php");
    }
    
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