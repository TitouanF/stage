<?php
  session_start()
?>
<html>
    <h1> récapitulatif des informations du salarié </h1>
    <?php
        $id = "titouan";
        require_once('connexion.php');
        $requete = "SELECT * from salarie where identifiant ='".$id."'";
        $resultat = $connection->query($requete);
        while($enregistrement = $resultat->fetch())
        {
           echo "identifiant : " . $enregistrement["identifiant"];
           echo "<BR> nom : " . $enregistrement["nom"];
           echo "<BR>prenom : " . $enregistrement["prenom"];
           echo "<BR>email : " . $enregistrement["email"];
           echo "<BR>preference : " . $enregistrement["preferences"];
           echo "<BR>ville : " . $enregistrement["ville"];
        }
    ?>
    <BR>
    <a href=""><button>valider</button></a>
    <a href="affichageSalarieAdmin.php"><button>annuler</button></a>
</html>