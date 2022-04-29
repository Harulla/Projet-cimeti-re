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
                    <TR><th> Nom </th><th> Prénom </th></TR>
                    <?php                        
                        $results = $cnx->query("SELECT o.num_occupant numoccupant, o.nom_occupant nom,o.prenom_occupant prenom, a.idconcession FROM projetp2.occupant o JOIN projetp2.autoriser a on o.num_occupant = a.num_occupant WHERE a.idconcession='$id';");
                        while($ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                            echo "<tr><td>$ligne->nom</td><td>$ligne->prenom</td></tr> ";
                        }
                    ?>
                    </table> 

                    <p> Occupants:</p>
                    <table >
                    <TR><th> Nom </th><th> Prénom </th></TR>
                    <?php  
                        $emp = $_GET['numEmp'];                      
                        $results = $cnx->query(" SELECT o.nom_occupant, o.prenom_occupant FROM projetp2.occuper occ JOIN projetp2.occupant o ON o.num_occupant = occ.num_occupant JOIN projetp2.tombe t ON t.numemplacement = occ.numemplacement WHERE t.numemplacement = '$emp';");
                        while($ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                            echo "<tr><td>$ligne->nom_occupant</td><td>$ligne->prenom_occupant</td></tr> ";
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