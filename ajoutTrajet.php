<?php
  header('Content-type: text/html; charset=UTF-8');
?>
<html>
  <head>
    <title>ajouter un trajet</title>
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
   <?php
    session_start();
    if ($_SESSION['verif'] == "admin")
          {
            header("Location: accueiladmin.php");
          }
          elseif ($_SESSION['verif'] == "salarie")
          {
            
          }
          else
          {
            header("Location: afficherlogin.php");
          }
          ?>
  </head>
  <body>
  <div class="form">
      <h1>Ajout d'un nouveau trajet</h1>
      
      <form id="ajoutTrajet" action="ajoutTrajetFin.php" method="post">
        <?php
          require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
          // Envoi de la requête vers MySQL   
          $select = $connection->query("SELECT * FROM ville");  
          // Les résultats retournés par la requête seront traités en 'mode' objet   
          echo "<BR><BR>choix d'une ville : ";
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
        ?>
        <BR><BR>
        nombre de places : <input type="number" id="nombrePlace" name="nombrePlace" min="1" max="9" required>
        <BR><BR>
        fréquence : 
        <select id="choixFrequence" name='choixFrequence'required>
          <option id="1">Quotidien</option>
          <option id="2">Exceptionnel</option>
        </select>
        <BR><BR>
        Aller ou retour : 
        <select id="choixType" name="choixType" required>
          <option id="1">Aller</option>
          <option id="2">Retour</option>
          <option id="3">Aller et retour</option>
        </select>
        <BR><BR>
        date du trajet : <input type="date" id="dateDepart" name="dateDepart"min="2019-01-01" max="2999-01-01" required>
        <BR><BR>
        Heure trajet : <input type="time" id="heureDepart" name="heureDepart"min="0:00" max="23:59" required>
        <BR><BR>      
        nombre d'étapes : <input type="number" id="nombreEtapes" name="nombreEtapes" min="0" max="9" text="0" required> <button type='button' id='etapes' onclick="afficheEtapes()">Ajouter les étapes</button>
        <BR><BR>
        <span id="AfficheEtapes"></span>
        <input type="submit" name="valid" value="Valider le trajet"/>    
      </form>
      <a class="monBoutton" href="accueilsalarie.php">Retour à l'accueil</a>
      <script>
        function afficheEtapes()
        {
          $('#AfficheEtapes').html("");
          tabVille = <?php echo $tabVille ?>;
          var i = 1;
          var ii;
          var maxLoop = <?php echo $max ?>;
          var max = document.getElementById("nombreEtapes").value;
          var texte ="";
          for (i=0;i<max;i++)
            {
              iafficher = i + 1;
              texte = "Choix de l'étape n°"+iafficher+" : <select id='choixVille' name='choixEtape"+iafficher+"' required>";
              for(ii=0;ii<maxLoop;ii ++)
              {
                texte += "<option>"+tabVille[ii]+"</option>";
              }
              ii = 0;
              texte +="</select><BR>";
              $('#AfficheEtapes').append(texte);
              texte = "";
            }
        }
      </script>
      </div>
      </div>
  </body>
</html>