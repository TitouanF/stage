<?php
    require_once('connexion.php');
    session_start();
    if ($_SESSION['verif'] == "salarie" && isset($_POST['choixVille']))
        {
            $identifiant =  $_SESSION['idSalarie'];
            $ville = $_POST['choixVille'];
            $nbPlace = $_POST['nombrePlace'];
            $frequence = $_POST['choixFrequence'];
            $type = $_POST['choixType'];
            $date = $_POST['dateDepart'];
            $heure = $_POST['heureDepart'];
            $max = $_POST['nombreEtapes'];
            $i = 1;   
            $resultat = $connection->query("select codePostal from ville where nom = '".$ville."'");
            $resultat->setFetchMode(PDO::FETCH_OBJ);
            $codeVille = $resultat->fetch();
            $stmt = 'INSERT INTO trajet (nbmax,frequence,typeTrajet,dateTrajet,heure,idSalarie,codeVille) VALUES ('.$nbPlace.',"'.$frequence.'","'.$type.'","'.$date.'","'.$heure.'","'.$identifiant.'",'.$codeVille->codePostal.')';
            try
                {
                    $connection->exec($stmt);
                }
            catch (Exception $e) 
                {
                    echo "ajout impossible : ", $e->getMessage();
                }
            $sql = "SELECT max(identifiant) as id FROM `trajet` WHERE 1";
            try
                {    
                    $effectuer = $connection->query($sql);
                    $effectuer->setFetchMode(PDO::FETCH_OBJ);
                    $resultat = $effectuer->fetch();   
                    $id = $resultat->id;
                }
            catch (Exception $e) 
                {
                    echo "récupération impossible : ", $e->getMessage();
                }
            for ($i = 1; $i <= $max; $i++)
                {
                    $teste = "choixEtape".$i;
                    $nomVille = $_GET[$teste];
                    
                    try
                        {
                            $requete = "select codePostal from ville where nom = '".$nomVille."'";
                            $result = $connection->query($requete);
                            $result->setFetchMode(PDO::FETCH_OBJ);
                            $result2 = $result->fetch();   
                            $cp = $result2->codePostal;
                            try
                                {

                                    $requete2 = "INSERT INTO etapes (`idTrajet`, `CodePostal`) VALUES ('".$id."', '".$cp."')";
                                    echo $requete2;
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
        elseif ($_SESSION['verif'] == "salarie" && !isset($_POST['choixVille']))
            {
               header("Location: ajoutTrajet.php");
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
<h1> Trajet ajouté </h1>
<a href ="accueilsalarie.php"> retour</a>