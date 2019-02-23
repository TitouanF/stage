<?php
  header('Content-type: text/html; charset=UTF-8');
  ?>
  <html>
  <head>
  <style>
   body 
        {
         background: #76b852;
         text-align: center;
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
  </style>
  </head>
<?php
  session_start();
  if(isset($_SESSION['verif']) && $_GET['idtrajet'] )
  {


      if ($_SESSION['verif'] == "salarie")
          {
            require_once('connexion.php');
            $idSalarie = $_SESSION['idSalarie'];
            $idTrajet = $_GET['idtrajet'];
            $requet = $connection->query("SELECT trajet.idSalarie idsal FROM trajet WHERE identifiant = '$idTrajet'");
            $requet->setFetchMode(PDO::FETCH_OBJ);
            while($enregist = $requet->fetch())
            {
              if ($enregist->idsal == $idSalarie)
              {
      
              }
              else
              {
                header("Location: voirmespropositiontrajet.php");
              }
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
  }
  else
  {
      header("Location: afficherlogin.php");
  }


  //Vérifie si l'utilisateur est connecté avant de montrer la page
  if ($_SESSION['verif'] == "salarie" && isset($_GET['idtrajet']))
  {
    require_once('connexion.php');
    $select = $connection->query("SELECT trajet.idSalarie idsal, ville.nom nomville FROM trajet, ville WHERE trajet.codeVille = ville.codePostal AND identifiant = '$idTrajet'");
    $select->setFetchMode(PDO::FETCH_OBJ);
    while($enregistrement = $select->fetch())
    {
      if ($enregistrement->idsal == $idSalarie)
      {
        echo("<body>");
        echo("<div class='form'");
        echo("<form action='suppressionTrajetFin.php' method='post'");
        echo("<h1>Confirmer la supression du trajet ".$enregistrement->nomville." ?</h1>");
        echo("<BR><button type='submit' value='Valider'>Valider</button></a>");
        echo("<input id='idtraj' name='idtraj' type='hidden' value='$idTrajet'>");
        echo("<a href='voirmespropositiontrajet.php'><button type='button'>Annuler</button></a>");
        echo("</form>");
        echo("</div>");
        echo("<body>");
        echo("<html>");
      }
    }
  }
  elseif ($_SESSION['verif'] == "salarie" && !isset($_GET['idtrajet']))
  {
      header("Location: accueilsalarie.php");
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