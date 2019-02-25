<?php
  header('Content-type: text/html; charset=UTF-8');
?>
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
<head>
    <title>modifications informations</title>
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
        text-align: center;
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
      .form button 
      {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #76b852;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
      }
      .form button:hover,.form button:active,.form button:focus 
      {
        background: #76b852;
      }
      .form .message 
      {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
      }
      .form .message a 
      {
        color: #76b852;
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
        text-align: center;
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
        background: #76b852; /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #76b852, #76b852);
        background: -moz-linear-gradient(right, #76b852, #76b852);
        background: -o-linear-gradient(right, #76b852, #76b852);
        background: linear-gradient(to left, #76b852, #76b852);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;      
      }       
      .monBoutton 
      {
        Color:#af4b4b; 
      }
    </style>
  </head>
        <body>
        <div class="form">
        <h1> Modifications de vos informations </h1>
        <form id="modifierSalarie" action="modificationSalarieFin.php" method="post">
       numero rue : <input type="number" name="numeroRue" min="1" value='<?php echo $numAdresse ?>' pattern="^[0-9]+$" required><BR>
       nom rue : <input type="text" name="nomRue" value='<?php echo $voieAdresse ?>' pattern="^[a-zA-Z0-9\s]+$"required><BR>
       email : <input type="email" name="mailSalarie"  value='<?php  echo $email ?>' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><BR>
       numéro téléphone (tout attaché) : <input type="text" value='<?php echo $telephone ?>' name="numeroSalarie" pattern="^0[1-7]{1}(([0-9]{2}){4})|((\s[0-9]{2}){4})|((-[0-9]{2}){4})$" required><BR>
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
         echo "</select><BR>";
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
            echo "</select><BR>";
            ?>
       </select><BR>
       <input type="submit" value="Valider">   
       </form>
       <a href="accueilsalarie.php">Retour</a>
       </div>
       </body>
</html>