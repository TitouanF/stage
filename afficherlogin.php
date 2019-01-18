<html>
  <head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    <div>
      <form action="veriflogin.php" method="post">
        <div style="padding: 5px">
          Identifiant : <select name="idSalarie" class="btn btn-primary dropdown-toggle">
            <?php
            require_once('connexion.php');

            $req=$connection->query("SELECT * FROM salarie WHERE identifiant <> 'admin'");

            $req->setFetchMode(PDO::FETCH_OBJ);

            while($enregistrement = $req->fetch())
            {
              echo("<option>".$enregistrement->identifiant."</option>");
            }
            ?>
          </select><br>
          Mot de Passe : <input type="password" class="form-control" style="width: 15%;" name="Mdp" required> 
          <input type="submit" class="btn btn-primary" value="Se Connecter">
          <input type="reset" class="btn btn-secondary" value="Annuler">
          <BR><BR>
          <a href="afficheradmin.html">Administrateur ?</a>
        </div>
      </form>
    </div>
  </body>
</html>
