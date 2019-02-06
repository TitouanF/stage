<?php 
 session_start();
 //Vérifie si l'utilisateur est connecté avant de montrer la page
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
    require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
    // Envoi de la requête vers MySQL   
    $select = $connection->query("SELECT * FROM salarie");  
    // Les résultats retournés par la requête seront traités en 'mode' objet   
    echo "<form action='suppressionSalarie.php' method='post'>";
    echo "choix d'un salarie : ";
    echo "<select id='choixPersonne' name='choixPersonne' required>";
    while($enregistrement = $select->fetch())
    {
        if ($enregistrement['nom'] != 'admin')
        {
            echo "<option>".$enregistrement['nom']."</option>";
        }        
    }
    echo "</select><BR>";
    echo "<input type='submit' value='Valider'>";
    echo "</form>";
    ?>