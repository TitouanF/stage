<html>
  <head>
    <title>ajouter un trajet</title>
    <link rel=stylesheet type="text/css" href="style.css"/>
  </head>
  <body>
    <h1>modifier salarie</h1>
      <?php
        require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
        // Envoi de la requête vers MySQL   
        $select = $connection->query("SELECT * FROM salarie");  
        // Les résultats retournés par la requête seront traités en 'mode' objet   
        echo "choix d'une salarie : ";
        echo "<select id='choixVille' name='choixVille' required>";
        while($enregistrement = $select->fetch())
        {
            if ($enregistrement['nom'] != 'admin')
            {
                echo "<option>".$enregistrement['nom']."</option>";
            }
         
        }
        echo "</select>";
      ?>
  </body>
</html>
