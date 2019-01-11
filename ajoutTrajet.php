<html>
  <head>
    <title>ajouter un trajet</title>
    <link rel=stylesheet type="text/css" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <h1>Ajout d'un nouveau trajet</h1>
    <form id="ajoutTrajet" action="ajoutTrajetFin.php">
      <?php
        require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
        // Envoi de la requête vers MySQL   
        $select = $connection->query("SELECT * FROM ville");  
        // Les résultats retournés par la requête seront traités en 'mode' objet   
        echo "choix d'une ville : ";
        echo "<select id='choixVille' name='choixVille' required>";
        $ij = 0;
        $tabVille="[";
        $max = 0;
        while($enregistrement = $select->fetch())
        {
          $nom = $enregistrement['nom'];
          $max += 1;     
          $inventaire[$ij] = $enregistrement['nom'];
          echo "<option>".$enregistrement['nom']."</option>";
          $ij = $ij + 1;
          // Constitution du "tableau" javascript
          if ($ij > 1)
          {
            $tabVille .= ",'$nom'";
          }
          else
          {
            $tabVille .= "'$nom'";
          }

        }
        $tabVille .= "]";
        
        echo "</select>";
        echo "tableau javascript : " . $tabVille;
      ?>
      <BR>
      nombre de places : <input type="number" id="nombrePlace" name="nombrePlace" min="1" max="9" required>
      <BR>
      fréquence : 
      <select id="choixFrequence" name='choixFrequence'required>
        <option id="1">Quotidien</option>
        <option id="2">Exceptionnel</option>
      </select>
      <BR>
      Aller ou retour : 
      <select id="choixType" name="choixType" required>
        <option id="1">Aller</option>
        <option id="2">Retour</option>
        <option id="3">Aller et retour</option>
      </select>
      <BR>
      date du trajet : <input type="date" id="dateDepart" name="dateDepart"min="2019-01-01" required>
      <BR>
      Heure trajet : <input type="time" id="heureDepart" name="heureDepart"min="0:00" max="23:59" required>
      <BR>      
      nombre d'étapes : <input type="number" id="nombreEtapes" name="nombreEtapes" min="0" max="9" text="0" required> <button type='button' id='etapes' onclick="afficheEtapes()">ok</button>
      <BR>
      <span id="AfficheEtapes"></span>
      <input type="submit" name="valid" value="ajouter"/>    
    </form> 
    <script>
      function afficheEtapes()
      {
        $('#AfficheEtapes').html("");  
        tabVille = <?php echo $tabVille ?>;
        var i = 1;
        var ii;
        var maxLoop = <?php echo $max?>;
        var max = document.getElementById("nombreEtapes").value;
        var texte ="";
       for (i=0;i<max;i++)
        {
          iafficher = i + 1;
          texte = "Choix de l'étape n°"+iafficher+" : <select id='choixVille' name='choixEtape"+iafficher+"' required><option>test</option>";

          for(ii=0;ii<maxLoop;ii ++)
          {
            texte += "<option>"+tabVille[ii]+"</option>";
          }
          ii = 0;
          texte +="</select><BR>"
          $('#AfficheEtapes').append(texte);  
          texte = "";
        }             
      }
      </script>
  </body>
</html>
