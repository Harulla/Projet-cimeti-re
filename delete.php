<!DOCTYPE html>  
<html>  
    <head>  
        <link rel="stylesheet" href="style.css">
        <title>Cimetière</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>  
    
    <body>  
    <div class="background">|
    <?php
            include("connexion.inc.php");
            include("header.php");
            session_start();

        ?>
            <div class="overlay">
                
                <div class="EcranCentral" >
                    <?php
                        if ($_SESSION['role']!=1){
                            header('location: accueil.php');
                        }

                        if (isset($_GET['idconcession'])){
                            $idConcession=$_GET['idconcession'];
                        }
                        if (isset($_GET['idoccupant'])){
                            $idOccupant=$_GET['idoccupant'];
                        }


                        $results = $cnx->query("SELECT COUNT(idconcession) nombre FROM projetp2.autoriser WHERE idconcession = '$idConcession' AND num_occupant='$idOccupant';");
                        
                        while($ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                            if(($ligne->nombre)>0){
                                $result2 = $cnx->query("DELETE FROM projetp2.autoriser WHERE idconcession = '$idConcession' AND num_occupant='$idOccupant';");
                                
                            }
                        }

                        header("location: concessionsDetails.php?id=$idConcession");
                    ?>
                </div>
            </div>
        </div>
        
        <div class="footer2">         </div> 
    </body>  
</html>