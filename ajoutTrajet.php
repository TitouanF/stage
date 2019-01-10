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
        while($enregistrement = $select->fetch())
        {
          $inventaire[$ij] = $enregistrement['nom'];
          echo "<option>".$enregistrement['nom']."</option>";
          $ij = $ij + 1;
        }
        echo "</select>";
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
      nombre d'étapes : <input type="number" id="nombreEtapes" name="nombreEtapes" min="0" max="9" text="0" required> <button type="button" id="etapes" onclick="afficheEtapes(<?php $inventaire?>)">ok</button>
      <BR>
      <span id="AfficheEtapes"></span>
      <input type="submit" name="valid" value="ajouter"/>    
    </form> 
    <script>
      function afficheEtapes(tabVilles)
      {
        var i = 1
        alert(tabVilles[0]);
      
       /* var max = document.getElementById("nombreEtapes").value;
          alert(max);
          for (i=0;i<max;i++)
          {
            iafficher = i + 1;
            var affRepas = document.getElementById("AfficheEtapes");
            affRepas.innerHTML = 
      
            $('#AfficheEtapes').append("Choix etape "+iafficher+" : <select id='choixVille' name='choixEtape"+iafficher+"' required><option>test</option>");
          
            
            $('#AfficheEtapes').append("</select><BR>");
              */      
      }
      </script>
  </body>
</html>
