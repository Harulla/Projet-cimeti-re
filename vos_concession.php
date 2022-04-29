<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cimetière</title>
</head>
<body>
    <?php
        include("connexion.inc.php");
        include("header.php");
    ?>

        <div class="background">|
            <div class="overlay">
                <h1> Concessions :</h1>
                
                <div class="EcranCentral" >
                <div class="scroll"> 
                    <table >
                        <TR><th> ID </th><th> DateDébut </th><th> Durée </th><th> Emplacement</th> <th> Plus de détails </th></TR>
                        <?php
                            
                            $results = $cnx->query("SELECT c.idconcession, c.date_debut, c.duree_concession, c.numemplacement FROM projep2.concession c JOIN projetp2.est_proprietaire estprop ON estprop.idconcession = c.idconcession JOIN projetp2.proprietaire p ON p.id_proprietaire = estprop.id_proprietaire WHERE  p.id_proprietaire = 2;");
                            
                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                echo "<tr><td>$ligne->idconcession</td><td>$ligne->date_debut</td><td>$ligne->duree_concession</td><td> N°$ligne->numemplacement</td> <td><a href=\"concessionsDetails.php?id=$ligne->idconcession\"> <img class=\"PetitLogo\" src=\"more.png\"> </a></td></tr> ";
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