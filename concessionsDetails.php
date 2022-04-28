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

            if (isset($_GET['id'])){
                $id = $_GET['id'];
            }
            
        ?>

        <div class="background">|
            <div class="overlay">
                <h1> Concessions :</h1>
                
                <div class="EcranCentral" >
                <div class="scroll"> 
                    <table >
                        <TR><th> ID </th><th> DateDébut </th><th> Durée </th><th> Emplacement</th></TR>
                        <?php
                        
                        $results = $cnx->query("SELECT idconcession, date_debut, duree_concession,numemplacement FROM projetp2.concession WHERE idconcession = '$id';");
                        while($ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                            echo "<tr><td>$ligne->idconcession</td><td>$ligne->date_debut</td><td>$ligne->duree_concession</td><td> N°$ligne->numemplacement</td></tr> ";
                        }
                        ?>
                    </table> 
                    <br/>
                    <p> Liste des personnes autorisées:</p>
                    <table >
                    <TR><th> Nom </th><th> Prénom </th><th> Supprimer </th></TR>
                    <?php                        
                        $results = $cnx->query("SELECT o.num_occupant numoccupant, o.nom_occupant nom,o.prenom_occupant prenom, a.idconcession FROM projetp2.occupant o JOIN projetp2.autoriser a on o.num_occupant = a.num_occupant WHERE a.idconcession='$id';");
                        while($ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                            echo "<tr><td>$ligne->prenom</td><td>$ligne->nom</td><td><a href=\"delete.php?idconcession=$id&amp;idoccupant=$ligne->numoccupant\"> <img class=\"PetitLogo\" src=\"remove.png\"> </a></td></tr> ";
                        }
                    ?>
                    </table> 
                    <form action="resultats_recherche_defunt.php" method="GET">
                            <input type="text" name="nom" size="20" placeholder="Nom :"/>
                            <input type="text" name="prenom" size="20" placeholder="Prénom :"/>
                            <input type="submit" name="previsualiser" value="Ajouter un héritier" />
                            <input type="submit" name="envoyer" value="Ajouter un occupant" />
                        </form>
                </div>
                </div>
            </div>
        </div>
        <div class="footer2">         </div> 
    </body>  
</html>