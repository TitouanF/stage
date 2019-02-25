<html>
  <head>
    <title>ajouter un salarié</title>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page 
      {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
      }
      .form 
      {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
      }
      .form input 
      {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
      }
      .titre
      {
        text-align: center;
      }
      .form button 
      {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #5276b8;
        width: 100%;
        border: 0;
        padding: 10px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
      }
      .form button:hover,.form button:active,.form button:focus 
      {
        background: #5276b8;
      }
      .form .message 
      {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
      }
      .form .message a 
      {
        color: #5276b8;
        text-decoration: none;
      }
      .form .register-form 
      {
        display: none;
      }
      .container
      {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
      }
      .container:before, .container:after 
      {
        content: "";
        display: block;
        clear: both;
      }
      .container .info 
      {
        margin: 50px auto;
      }
      .container .info h1 
      {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
      }
      .container .info span 
      {
        color: #4d4d4d;
        font-size: 12px;
      }
      .container .info span a 
      {
        color: #000000;
        text-decoration: none;
      }
      .container .info span .fa 
      {
        color: #EF3B3A;
      }
      body 
      {
        background: #5276b8; /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #5276b8, #5276b8);
        background: -moz-linear-gradient(right, #5276b8, #5276b8);
        background: -o-linear-gradient(right, #5276b8, #5276b8);
        background: linear-gradient(to left, #5276b8, #5276b8);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;      
      }
    </style>
  </head>
  <body>
  <?php
    session_start();
    if(isset($_SESSION['verif']))
    {


    if ($_SESSION['verif'] == "admin")
          {
            //le code continue en bas
          }
          elseif ($_SESSION['verif'] == "salarie")
          {
            header("Location: accueilsalarie.php");
          }
          else
          {
            header("Location: afficherlogin.php");
          }
        }
          else
          {
            header("Location: afficherlogin.php");
          }
    ?>
    <div class="form">
    <h1 class="titre">Ajout d'un nouveau salarié</h1>
    <form id="ajoutSalarie" action="ajoutSalarieFin.php" method="post">
      <input type="text" name="idSalarie" pattern="^[a-zA-Z0-9]+$" placeholder="identifiant" required><BR>
       <input type="text" name="nomSalarie" pattern="^[a-zA-Z]+$" placeholder="nom" required><BR>
       <input type="text" name="prenomSalarie" pattern="^[a-zA-Z]+$" placeholder="prenom" required><BR>
       <input type="text" name="mdpSalarie" pattern="^[a-zA-Z0-9]+$" placeholder="mot de passe" required><BR>
       <input type="number" name="numeroRue" pattern="^[0-9]+$" placeholder="numéro rue" required><BR>
       <input type="text" name="nomRue" pattern="^[a-zA-Z0-9\s]+$" placeholder="nom de la rue" required><BR>
       <input type="email" name="mailSalarie" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="adresse mail" required><BR>
      <input type="text" name="numeroSalarie" pattern="^0[1-7]{1}(([0-9]{2}){4})|((\s[0-9]{2}){4})|((-[0-9]{2}){4})$" placeholder="numéro téléphone" required><BR>
      <div class="titre">préférences : 
       <select id="choixType" name="choixType" class="btn btn-primary dropdown-toggle" required>
        <option id="1">Aller</option>
        <option id="2">Retour</option>
        <option id="3">Aller et retour</option>
       </select><BR> <BR></div>
        <?php   
        require_once('connexion.php'); // once : le fichier ne peut être demandé qu'une fois
        // Envoi de la requête vers MySQL   
        $select = $connection->query("SELECT * FROM ville");  
        // Les résultats retournés par la requête seront traités en 'mode' objet   
        echo "ville d'habitation : ";
        echo "<select id='choixVille' name='choixVille' class='btn btn-primary dropdown-toggle' required>";
        while($enregistrement = $select->fetch())
        {
          echo "<option>".$enregistrement['nom']."</option>";
        }
        echo "</select>";
      ?>
      <BR><BR>
       <input type="submit" value="ajouter">
    </form>
    <a href="accueiladmin.php">annuler</a>
      </div>
  </body>
</html>