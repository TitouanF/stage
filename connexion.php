<?php
  // Connection au serveur
  try {
    $dns = 'mysql:host=localhost;dbname=covoiturage'; // dbname : nom de la base
    $utilisateur = 'root'; // root sur vos postes
    $motDePasse = ''; // pas de mot de passe sur vos postes
    $connection = new PDO( $dns, $utilisateur, $motDePasse );
  } catch (Exception $e) {
    echo "Connexion &agrave MySQL impossible : ", $e->getMessage();
    die();
  }
?>
