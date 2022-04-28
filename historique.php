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
            $prenom = $_GET['prenom'];
            $nom = $_GET['nom'];
            
            
        ?>

        <div class="background">|
            <div class="overlay">
                <h1> Historique de déplacements</h1>
                <?php
                echo "<h3> $nom $prenom</h3>";
                ?>

                <div class="EcranCentral" >
                    <div class="scroll">
                    <table >
                        
                        <TR><th> Lieu </th><th> Motif </th><th> Date Arrivée </th><th> Date Départ</th></TR>
                        <?php
                            $results = $cnx->query("SELECT occ.numemplacement numemplacement, occ.num_occupant num_occupant, occ.datearrivee datearrivee, occ.datedepart datedepart, occ.motif_deplacement motif_deplacement FROM projetp2.occuper occ JOIN projetp2.occupant o ON o.num_occupant = occ.num_occupant WHERE o.nom_occupant = '$nom' AND o.prenom_occupant = '$prenom' ORDER BY datearrivee DESC;");
                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                $emplacement='';
                                $results2 = $cnx->query("SELECT COUNT(numemplacement) AS nombre FROM projetp2.tombe WHERE numemplacement='$ligne->numemplacement';");
                                while( $ligne2 = $results2->fetch(PDO::FETCH_OBJ) ) {
                                    if (($ligne2->nombre)>0){
                                        $results3 = $cnx->query("SELECT numemplacement,allee FROM projetp2.tombe WHERE numemplacement='$ligne->numemplacement';");
                                        while( $ligne3 = $results3->fetch(PDO::FETCH_OBJ) ) {
                                            $emplacement=$emplacement."Tombe n°".substr($ligne3->numemplacement , 7, 3)."<br/> $ligne3->allee <br/>";
                                        }
                                    }else{
                                        $results3 = $cnx->query("SELECT numemplacement,nom_ossuaire FROM projetp2.ossuaire WHERE numemplacement='$ligne->numemplacement';");
                                        while( $ligne3 = $results3->fetch(PDO::FETCH_OBJ) ) {
                                            $emplacement=$emplacement."$ligne3->nom_ossuaire <br/>";
                                        }
                                    }
                                }
                                echo "<tr><td>$emplacement</td><td>$ligne->motif_deplacement</td><td>$ligne->datearrivee</td><td>$ligne->datedepart</td></tr>";
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