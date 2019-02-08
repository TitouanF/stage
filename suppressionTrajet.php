<?php
  header('Content-type: text/html; charset=UTF-8');
?>
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
        echo("<html>");
        echo("<body>");
        echo("<form action='suppressionTrajetFin.php' method='post'");
        echo("<h1>Confirmer la supression du trajet ".$enregistrement->nomville." ?</h1>");
        echo("<button type='submit' value='Valider'>Valider</button></a>");
        echo("<input id='idtraj' name='idtraj' type='hidden' value='$idTrajet'>");
        echo("<a href='voirmespropositiontrajet.php'><button type='button'>Annuler</button></a>");
        echo("</form>");
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