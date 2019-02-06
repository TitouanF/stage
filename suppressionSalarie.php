<?php
  session_start();
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
?>
<html>
    <h1> récapitulatif des informations du salarié </h1>
    <form action="suppressionSalarieFin.php" method="post">
    <?php
        $nom = $_POST['choixPersonne'];
        require_once('connexion.php');
        $requete = "SELECT * from salarie where nom ='".$nom."'";
        $resultat = $connection->query($requete);
        while($enregistrement = $resultat->fetch())
        {
           echo "identifiant : " . $enregistrement["identifiant"];
           echo "<BR> nom : " . $enregistrement["nom"];
           echo "<BR>prenom : " . $enregistrement["prenom"];
           echo "<BR>email : " . $enregistrement["email"];
           echo "<BR>preference : " . $enregistrement["preferences"];
           echo "<BR>ville : " . $enregistrement["ville"];
          echo ' <input type="hidden" name="id" value="'. $enregistrement["identifiant"].'">';
        }
    ?> 
    <BR>
    <input type='submit' value='Supprimer'>
    </form>
    <a href="accueiladmin.php"><button>annuler</button></a>
</html> 