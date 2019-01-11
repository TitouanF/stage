<html>
  <head>
    <title>ajouter un salarié</title>
    <link rel=stylesheet type="text/css" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <h1>Ajout d'un nouveau salarié</h1>
    <form id="ajoutSalarie" action="ajoutSalarieFin.php" method="post">
       identifiant : <input type="text" name="idSalarie" pattern="^[a-zA-Z0-9]+$"><BR>
       nom : <input type="text" name="nomSalarie" pattern="^[a-zA-Z]+$"><BR>
       prenom : <input type="text" name="prenomSalarie" pattern="^[a-zA-Z]+$"><BR>
       mdp : <input type="text" name="mdpSalarie" pattern="^[a-zA-Z0-9]+$"><BR>
       numero rue : <input type="number" name="numeroRue" pattern="^[0-9]+$"><BR>
       nom rue : <input type="text" name="nomRue" pattern="^[a-zA-Z0-9\s]+$" ><BR>
       email : <input type="email" name="mailSalarie" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><BR>
       numéro téléphone (tout attaché) : <input type="text" name="numeroSalarie" pattern="^0[1-6]{1}(([0-9]{2}){4})|((\s[0-9]{2}){4})|((-[0-9]{2}){4})$"><BR>
       préférences : 
       <select id="choixType" name="choixType" required>
        <option id="1">Aller</option>
        <option id="2">Retour</option>
        <option id="3">Aller et retour</option>
       </select><BR>
        <?php   
        require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
        // Envoi de la requête vers MySQL   
        $select = $connection->query("SELECT * FROM ville");  
        // Les résultats retournés par la requête seront traités en 'mode' objet   
        echo "ville d'habitation : ";
        echo "<select id='choixVille' name='choixVille' required>";
        while($enregistrement = $select->fetch())
        {
          echo "<option>".$enregistrement['nom']."</option>";
        }
        echo "</select>";
      ?>
       <input type="submit" value="ajouter">
    </form>
  </body>
</html>