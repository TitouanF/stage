<?php
    require_once('connexion.php');
    $ville = $_GET['choixVille'];
    $nbPlace = $_GET['nombrePlace'];
    $frequence = $_GET['choixFrequence'];
    $type = $_GET['choixType'];
    $date = $_GET['dateDepart'];
    $heure = $_GET['heureDepart'];
    $resultat = $connection->query("select codePostal from ville where nom = '".$ville."'");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $codeVille = $resultat->fetch();
    echo $codeVille->codePostal;

    $stmt = 'INSERT INTO trajet (nbmax,frequence,typeTrajet,dateTrajet,heure,codeVille) VALUES ('.$nbPlace.',"'.$frequence.'","'.$type.'","'.$date.'","'.$heure.'",'.$codeVille->codePostal.')';
    echo $stmt;
    try
    {
        $connection->exec($stmt);
    }
    catch (Exception $e) 
    {
        echo "ajout impossible : ", $e->getMessage();
      }
    
?>