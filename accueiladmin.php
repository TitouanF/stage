<?php
  session_start();
  if ($_SESSION['verif'] == "admin")
  {
    
  }
  elseif ($_SESSION['verif'] == "salarie")
  {
    header("Location: accueilsalarie.php");
  }
  else
  {
    header("Location: afficherlogin.php");
  }
?>
<html>
  <head>
    <title>Salaries</title>
    <link rel=stylesheet type="text/css" href="style.css"/>
  </head>
  <body>
  <?php
      //Vérifie si l'utilisateur est connecté avant de montrer la page
      if ($_SESSION['verif'] == "admin")
      {

      }
      elseif ($_SESSION['verif'] == "salarie")
      {
        header("Location: accueilsalarie.php");
      }
      else
      {
        header("Location: afficherlogin.php");
      }
  ?>
    <h1>Accueil admin</h1>
      <?php
        require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
        // Envoi de la requête vers MySQL   
        $select = $connection->query("SELECT * FROM salarie");  
        // Les résultats retournés par la requête seront traités en 'mode' objet   
        echo "<ul><lh>Liste des salariés inscrits</lh>";
        while($enregistrement = $select->fetch())
        {
            if ($enregistrement['nom'] != 'admin')
            {
                echo "<li>".$enregistrement['nom']." ".$enregistrement['prenom']."</li>";
            }        
        }

        echo "</ul>";
      ?>
    <br> 
    <a href="ajoutSalarie.php"><button >Ajouter un salarie</button></a>
    <a href="choixSalarieSuppression.php"><button>Supprimer un salarie</button></a>
    <BR>
  <a href="deconnection.php"><button>Deconnexion</button></a>
  </body>
  <script>
  </script>
</html>
