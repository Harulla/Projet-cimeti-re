<!DOCTYPE html>  
<html>  
    <head>  
        <link rel="stylesheet" href="style.css">
        <title>Cimetière</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>  
    
    <body>  
        <?php
            include("connexion.inc.php");
            include("header.php");
            session_start();

            if ($_SESSION['role']!=1){
                header('location: accueil.php');
            }
            
        ?>

        <div class="background">|
            <div class="overlay">
                <h1> Personnes enregistrées :</h1>
                <form action="personnes.php" method="post">
                        <label for="nom">Nom :</label><input type="text" name="nom" />
                        <label for="prenom">Prenom :</label><input type="text" name="prenom" />
                        <input type="submit" name="submit" value="Rechercher" />
                    </form>
                <div class="EcranCentral" >
                    <div class="scroll">
                    <table >
                        <TR><th> Nom </th><th> Prénom </th><th> Concessions </th><th> Contact</th> <th> Historique </th> </TR>
                        <?php
                            
                            if (isset($_POST['nom'])){
                                $nom = "%".$_POST['nom']."%";
                            }else{
                                $nom = "%%";
                            }
                            if (isset($_POST['prenom'])){
                                $prenom = "%".$_POST['prenom']."%";
                            }else{
                                $prenom = "%%";
                            }
                            $results = $cnx->query("SELECT num_occupant, nom_occupant, prenom_occupant FROM projetp2.occupant WHERE nom_occupant LIKE '$nom' AND prenom_occupant LIKE '$prenom' ORDER BY nom_occupant;");
                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                $contact = "";
                                $results2 = $cnx->query("SELECT p.nomcontact as nomcontact, p.prenomcontact as prenomcontact, p.numtel as numtel FROM projetp2.personneacontacter p JOIN projetp2.gerer g ON g.num_contact=p.num_contact WHERE g.num_occupant = '$ligne->num_occupant';");
                                while( $ligne2 = $results2->fetch(PDO::FETCH_OBJ) ) {
                                    $contact=$contact."$ligne2->nomcontact $ligne2->prenomcontact <br/> $ligne2->numtel <br/>";
                                }

                                $concession = "";
                                $results3 = $cnx->query("SELECT a.idconcession as id FROM projetp2.autoriser a WHERE a.num_occupant = '$ligne->num_occupant';");
                                while( $ligne3 = $results3->fetch(PDO::FETCH_OBJ) ) {
                                    $concession=$concession."$ligne3->id <br/>";
                                }
                                echo "<tr><td>$ligne->nom_occupant</td><td>$ligne->prenom_occupant</td><td>$concession</td><td> $contact</td> <td> <a href=\"historique.php?prenom=$ligne->prenom_occupant&amp;nom=$ligne->nom_occupant\"> <img class=\"PetitLogo\" src=\"historique.png\"> </a></td> </tr>";
                            }
                        ?>
                        
                    </table> 
                    </div>
                </div>
                
            </div>
        </div>
        <div class="footer2">         </div> 
    </body>  
</html>