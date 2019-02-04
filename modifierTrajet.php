<html>
  <head>
    <title>Modifier Trajet</title>
  </head>
  <body>
  <?php
    session_start();
    $idSalarie = $_SESSION['idSalarie'];
    $idTrajet = $_GET['idtrajet'];
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
    ?>
    <h1>Modification du trajet</h1>
    <form action="modifierTrajetFin.php" method="post">
      <?php   
          require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
          // Envoi de la requête vers MySQL   
          $select = $connection->query("SELECT ville.nom nom, trajet.dateTrajet datet, trajet.heure heure, trajet.typeTrajet typet, trajet.frequence frequence FROM ville, trajet WHERE ville.codePostal = trajet.codeVille AND trajet.identifiant = '$idTrajet'");
          // Les résultats retournés par la requête seront traités en 'mode' objet   
          $select->setFetchMode(PDO::FETCH_OBJ);
          
          while($enregistrement = $select->fetch())
          {
            $ville = $enregistrement->nom;
            $frequence = $enregistrement->frequence;
            $type = $enregistrement->typet;
            $date = $enregistrement->datet;
            $heure = $enregistrement->heure;
          }

        // Envoi de la 2ème requête vers MySQL
        $select2 = $connection->query("SELECT ville.nom nom FROM ville");
        // Les résultats retournés par la requête seront traités en 'mode' objet   
        $select2->setFetchMode(PDO::FETCH_OBJ);
        echo "Ville : ";
        echo "<select id='choixVille' name='choixVille' required>";
        while($enregistrement2 = $select2->fetch())
          {
            if($ville == $enregistrement2->nom)
            {
              echo "<option selected>".$enregistrement2->nom."</option>";
            }
            else
            {
              echo "<option>".$enregistrement2->nom."</option>";
            }
          }
          echo "</select>";
          echo "<BR>";


          echo "Frequence : ";
          echo "<select id='frequence' name='frequence' required>";
          if($frequence == "Quotidien")
            {
              echo "<option selected>Quotidien</option>";
              echo "<option>Exceptionnel</option>";
            }
            else
            {
              echo "<option>Quotidien</option>";
              echo "<option selected>Exceptionnel</option>";
            }
          echo "</select>";
          echo "<BR>";


          echo "Type de trajet : ";
          echo "<select id='type' name='type' required>";
          if($type == "Aller")
            {
              echo "<option selected>Aller</option>";
              echo "<option>Retour</option>";
              echo "<option>Aller/Retour</option>";
            }
            elseif($type == "Retour")
            {
              echo "<option>Aller</option>";
              echo "<option selected>Retour</option>";
              echo "<option>Aller/Retour</option>";
            }
            else
            {
              echo "<option>Aller</option>";
              echo "<option>Retour</option>";
              echo "<option selected>Aller/Retour</option>";
            }
          echo "</select>";
          echo "<BR>";


          echo "Date : ";
          echo "<input type='date' value='$date' required>";
          echo "<BR>";
          echo "Heure : ";
          echo "<input type='time' value='$heure' required>";
          echo "<BR>";


          //LES ETAPES
        ?>
      <input type="submit" value="Modifier">
      <a href="accueilsalarie.php"><button>Retour</button></a>
    </form>
  </body>
</html>