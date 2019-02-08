<?php
  header('Content-type: text/html; charset=UTF-8');
?>
<?php
    require_once('connexion.php');
    session_start();
    if ($_SESSION['verif'] == "salarie" && isset($_POST['idTrajet']))
    {
        $identifiant =  $_SESSION['idSalarie'];
        $idTrajet = $_POST['idTrajet'];
        $ville = $_POST['choixVille'];
        $frequence = $_POST['choixFrequence'];
        $type = $_POST['choixType'];
        $date = $_POST['dateDepart'];
        $heure = $_POST['heureDepart'];
        $max = $_POST['nbEtape'];
        echo $idTrajet;
        //Récupération du code ville pour modifier la ville du trajet
        $requete = "SELECT codePostal FROM ville WHERE nom = '".$ville."'";
        $result = $connection->query($requete);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $result2 = $result->fetch();   
        $cpVille = $result2->codePostal;

        //Modification de la table trajet
        $req=$connection->query("UPDATE trajet SET frequence = '$frequence', typeTrajet = '$type', dateTrajet ='$date', heure = '$heure', codeVille = '$cpVille' WHERE identifiant = '$idTrajet'");

        //Suppression de toutes les étapes du trajet
        $req=$connection->query("DELETE FROM etapes WHERE idTrajet = '$idTrajet'");

        //Insertion des étapes
        for ($i = 1; $i <= $max; $i++)
        {
            $etape = "listeEtape".$i;
            $nomVille = $_POST[$etape];
            
            try
            {
                $requete2 = "SELECT codePostal FROM ville WHERE nom = '".$nomVille."'";
                $result2 = $connection->query($requete2);
                $result2->setFetchMode(PDO::FETCH_OBJ);
                $result3 = $result2->fetch();   
                $cp = $result3->codePostal;
                try
                {
                    $requete2 = "INSERT INTO etapes (`idTrajet`, `CodePostal`) VALUES ('".$idTrajet."', '".$cp."')";
                    $connection->exec($requete2);
                }
                catch (Exception $e) 
                {
                    echo "ajout impossible : ", $e->getMessage();
                }
            }
            catch (Exception $e) 
            {
                echo "ajout impossible : ", $e->getMessage();
            }
        }
    }
    elseif ($_SESSION['verif'] == "salarie")
    {
        header("Location: voirmespropositiontrajet.php");
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
<h1> Trajet modifie </h1>
<a href ="voirmespropositiontrajet.php"> retour</a>