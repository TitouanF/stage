<?php
require_once('connexion.php');
    $ville = $_POST['choixVille'];
    $nbPlace = $_POST['nombrePlace'];
    $frequence = $_POST['choixFrequence'];
    $type = $_POST['choixType'];
    $date = $_POST['dateDepart'];
    $heure = $_POST['heureDepart'];
    $stmt = $db->prepare('INSERT INTO trajet (nbmax,frequence,type,date,heure,codeVille) VALUES (:nb, :frequence, :type,:date:heure:codeville)');
    try
    {
        $stmt->execute(array(':nb' => $nbPlace,':frequence' => $frequence, ':type' => $type, ':date' => $date, ':heure' => $heure, ':codeVille' => $codeVille));
    }
    catch (Exception $e) 
    {
        echo "ajout impossible : ", $e->getMessage();
      }
    
?>