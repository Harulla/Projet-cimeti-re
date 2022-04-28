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
        ?>

        <div class="background">|
            <div class="overlay">
                <h1> Voici les résultats correspondant:</h1>
                <div class="EcranCentral" >
                    <div class="scroll">
                    <table >
                        <TR><th> Nom </th><th> Prénom </th><th> Allée </th><th> Emplacement</th></TR>
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
                            if (isset($_POST['allee'])){
                                $allee = '%Allee'.$_POST['allee']."%";
                        
                            }else{
                                $allee = "%%";
                            }
                            $results = $cnx->query("SELECT DISTINCT o.nom_occupant, o.prenom_occupant, o.num_occupant, t.allee, t.numemplacement FROM projetp2.occuper occ 
                            JOIN projetp2.occupant o ON o.num_occupant =  occ.num_occupant 
                            JOIN projetp2.tombe t ON t.numemplacement = occ.numemplacement 
                            WHERE t.allee LIKE '$allee' 
                            AND o.nom_occupant LIKE '$nom' 
                            AND o.prenom_occupant LIKE '$prenom' 
                            (select Selection.DateArrivee from projetp2.occuper Selection where (Selection.num_occupant = occ.num_occupant) ORDER BY Selection.DateArrivee DESC LIMIT 1)
                            ORDER BY o.nom_occupant;");


                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                echo "<tr><td>$ligne->nom_occupant</td><td>$ligne->prenom_occupant</td><td>$ligne->allee</td><td> N°$ligne->numemplacement</td></tr>";
                            }
                        ?>
                        
                    </table>    
                    </div>
                </div>
            </div>
        </div>
        <div class="footer2"></div> 
    </body>  
</html>