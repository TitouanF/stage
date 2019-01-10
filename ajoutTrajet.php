<html>
  <head>
    <title>ajouter un trajet</title>
    <link rel=stylesheet type="text/css" href="style.css"/>
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
        while($enregistrement = $select->fetch())
        {
          echo "<option>".$enregistrement['nom']."</option>";;
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
      <input type="submit" name="valid" value="ajouter"/>
    </form>
  </body>
</html>
