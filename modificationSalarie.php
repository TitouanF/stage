<?php
  session_start();
  //Vérifie si l'utilisateur est connecté avant de montrer la page
  if ($_SESSION['verif'] == "salarie")
  {  
      require_once('connexion.php');
      $idSalarie = $_SESSION['idSalarie'];
      $requete = "SELECT numAdresse,voieAdresse,ville,email,telephone,preferences FROM salarie WHERE identifiant = '$idSalarie'";
      $req=$connection->query($requete); 
      $req->setFetchMode(PDO::FETCH_OBJ);
      while($enregistrement = $req->fetch())
          {
            $numAdresse = $enregistrement->numAdresse;
            $voieAdresse = $enregistrement->voieAdresse;
            $email = $enregistrement->email;
            $telephone = $enregistrement->telephone;
            $preferences = $enregistrement->preferences;
            $ville = $enregistrement->ville;
          }
  }
  elseif ($_SESSION['verif'] == "admin")
  {
    header("Location: accueiladmin.php");
  }
  else
  {
    header("Location: afficherlogin.php");
  }
?>
<html>
  <form id="modifierSalarie" action="modificationSalarieFin.php" method="post">
       numero rue : <input type="number" name="numeroRue" value='<?php echo $numAdresse ?>' pattern="^[0-9]+$"><BR>
       nom rue : <input type="text" name="nomRue" value='<?php echo $voieAdresse ?>' pattern="^[a-zA-Z0-9\s]+$" ><BR>
       email : <input type="email" name="mailSalarie"  value='<?php  echo $email ?>' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><BR>
       numéro téléphone (tout attaché) : <input type="text" value='<?php echo $telephone ?>' name="numeroSalarie" pattern="^0[1-6]{1}(([0-9]{2}){4})|((\s[0-9]{2}){4})|((-[0-9]{2}){4})$"><BR>
       préférences : 
       <select id="choixType" name="choixType" required>
       <?php 
        if($preferences == "Aller")
            {
             echo '<option id="1" selected>Aller</option>
                    <option id="2">Retour</option>
                    <option id="3">Aller et retour</option>';
            }
          else if($preferences == "Retour")
            {
            echo '<option id="1" >Aller</option>
                    <option id="2"selected >Retour</option>
                      <option id="3">Aller et retour</option>';
            }
          else if($preferences == "Aller et retour")
          {
            echo '<option id="1" >Aller</option>
                <option id="2">Retour</option>
                <option id="3" selected >Aller et retour</option>';
          }
          else
          {
            echo '<option id="1" >Aller</option>
                    <option id="2">Retour</option>
                    <option id="3" >Aller et retour</option>';
          }
         echo "</select>";
          echo "<BR>";
          $select = $connection->query("SELECT * FROM ville");  
          $select->setFetchMode(PDO::FETCH_OBJ);
            // Les résultats retournés par la requête seront traités en 'mode' objet   
            echo "ville d'habitation : ";
            echo "<select id='choixVille' name='choixVille' required>";
            while($enregistrement2 = $select->fetch())
            { 
                if ($enregistrement2->codePostal == $ville)
                {
                    echo "<option selected>".$enregistrement2->codePostal."</option>";
                }
                else
                {
                    echo "<option>".$enregistrement2->codePostal."</option>";
                }
            
            }
            echo "</select>";
            ?>
       </select><BR>
       <input type="submit" value="Valider">
       <a href="accueilsalarie.php"><button>Annuler les modifications</button></a>
       </form>
</html>