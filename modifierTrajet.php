<html>
  <head>
    <title>Modifier Trajet</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        table, td, th {
        border: 1px solid black;
        }

        table {
        border-collapse: collapse;
        width: 15%;
        }

        th {
        height: 50px;
        }
        th, td {
        padding: 15px;
        text-align: left;
        }
    </style>
  </head>
  <body>
  <?php
    session_start();
    require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
    $idSalarie = $_SESSION['idSalarie'];
    $idTrajet = $_GET['idtrajet'];
    if ($_SESSION['verif'] == "salarie" && isset($_GET['idtrajet']))
          {
            $requet = $connection->query("SELECT trajet.idSalarie idsal FROM trajet WHERE identifiant = '$idTrajet'");
            $requet->setFetchMode(PDO::FETCH_OBJ);
            while($enregist = $requet->fetch())
            {
              if ($enregist->idsal == $idSalarie)
              {

              }
              else
              {
                header("Location: voirmespropositiontrajet.php");
              }
            }
          }
          elseif ($_SESSION['verif'] == "salarie" && !isset($_POST['choixVille']))
          {
            header("Location: accueilsalarie.php");
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
        $nbVilles = 0;
        $tabVille="[";
        echo "Ville : ";
        echo "<select id='choixVille' name='choixVille' required>";
        while($enregistrement2 = $select2->fetch())
          {
            //Remplissage du tableau de villes pour javascript
            $nbVilles = $nbVilles + 1;
            if ($nbVilles > 1)
            {
              $tabVille .= ",'$enregistrement2->nom'";
            }
            else
            {
              $tabVille .= "'$enregistrement2->nom'";
            }



            if($ville == $enregistrement2->nom)
            {
              echo "<option selected>".$enregistrement2->nom."</option>";
            }
            else
            {
              echo "<option>".$enregistrement2->nom."</option>";
            }
          }
          //Fin de tableau de ville
          $tabVille .= "]";
          echo "</select>";
          echo "<BR>";


          echo "Frequence : ";
          echo "<select id='choixFrequence' name='choixFrequence' required>";
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
          echo "<select id='choixType' name='choixType' required>";
          if($type == "Aller")
            {
              echo "<option selected>Aller</option>";
              echo "<option>Retour</option>";
              echo "<option>Aller et Retour</option>";
            }
            elseif($type == "Retour")
            {
              echo "<option>Aller</option>";
              echo "<option selected>Retour</option>";
              echo "<option>Aller et Retour</option>";
            }
            else
            {
              echo "<option>Aller</option>";
              echo "<option>Retour</option>";
              echo "<option selected>Aller et Retour</option>";
            }
          echo "</select>";
          echo "<BR>";


          echo "Date : ";
          echo "<input id='dateDepart' name='dateDepart' type='date' value='$date' min='2019-01-01' required>";
          echo "<BR>";
          echo "Heure : ";
          echo "<input id='heureDepart' name='heureDepart' type='time' value='$heure' min='0:00' max='23:59' required>";
          echo "<BR>";


          //Les Etapes
          echo("Les Etapes : ");
          echo("<br>");
          echo("<table id='tabEtapes'>");
          echo("<tr>");
          echo("<th>Ville</th>");
          echo("</tr>");

          $req3=$connection->query("SELECT ville.nom nom FROM ville, trajet, etapes WHERE ville.codePostal = etapes.CodePostal AND trajet.identifiant = etapes.idTrajet AND trajet.identifiant = '$idTrajet'");
          $req3->setFetchMode(PDO::FETCH_OBJ);
          $nbr=$req3->rowCount();
          $nbEtape = 0;
          if($nbr > 0)
          {
            //Tant qu'il y a des étapes
            while($enregistrement3 = $req3->fetch())
            {
              $villeEtape = $enregistrement3->nom;
              $nbEtape = $nbEtape + 1;
              echo("<tr><td>");
              echo("<select name='listeEtape".$nbEtape."'>");

              $select2 = $connection->query("SELECT ville.nom nom FROM ville");
              $select2->setFetchMode(PDO::FETCH_OBJ);
              //Tant qu'il y a des villes
              while($enregistrement2 = $select2->fetch())
              {
                if($villeEtape == $enregistrement2->nom)
                {
                  echo "<option selected>".$enregistrement2->nom."</option>";
                }
                else
                {
                  echo "<option>".$enregistrement2->nom."</option>";
                }
              }
              echo("</select>");
              echo("</td></tr>");
            }
          }
          elseif($nbr == 0)
          {
            echo("<tr><td>");
            echo("Aucune etape");
            echo("</td></tr>");
          }

          echo("</table>");
          
          if($nbEtape < 9)
          {
            echo("<span id='ajoutL'><button type='button' onclick='ajoutLigne()'>Ajouter une Etape</button></span>");
          }
          
        ?>
        
    <input type='hidden' id='nbEtape' name='nbEtape' value='<?php echo $nbEtape ?>'>
    <input type='hidden' id='idTrajet' name='idTrajet' value='<?php echo $idTrajet ?>'>
    <button type='button' onclick='supprLigne()'>Supprimer la derniere etape</button>
    <BR><BR>
    <input type='submit' value='Modifier'>
    <a href="modifierTrajet.php?idtrajet=<?php echo $idTrajet ?>"><button type="button">Annuler</button></a>
    <?php
      echo("<a href='suppressionTrajet.php?idtrajet=".$idTrajet."'><button type='button'>Supprimer le Trajet</button></a>");
    ?>
      
    </form>
    <a href="voirmespropositiontrajet.php"><button type="button">Retour</button></a>
    <script>
      function supprLigne()
      {
        nbEtape = document.getElementById('nbEtape').value;
        if(nbEtape > 0)
        {
          nbEtape = parseInt(nbEtape) - 1;
          document.getElementById('nbEtape').value = nbEtape;
          document.getElementById('tabEtapes').deleteRow(-1);
        }
        if(nbEtape < 9)
        {
          $('#ajoutL').html("<button type='button' onclick='ajoutLigne()'>Ajouter une Etape</button>");
        }
      }
      function ajoutLigne()
      {
        nbEtape = document.getElementById('nbEtape').value;
        nbEtape = parseInt(nbEtape) + 1;
        tabVille = <?php echo $tabVille ?>;
        texte = "";
        ii = 0;
        nbVilles = <?php echo $nbVilles ?>;

        texte = "<tr><td><select name='listeEtape"+nbEtape+"' required>";
        for(ii=0;ii<nbVilles;ii ++)
        {
          texte += "<option>"+tabVille[ii]+"</option>";
        }
        //this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
        texte += "</select></td></tr>";
        $('#tabEtapes').append(texte);
        document.getElementById('nbEtape').value = nbEtape;
        if(nbEtape >= 9)
        {
          $('#ajoutL').html("");
        }
      }
    </script>
  </body>
</html>