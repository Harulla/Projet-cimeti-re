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
                
                <div class="EcranCentral" >
                
                <?php
                    if (isset($_POST['nom'])){
                        $nom=$_POST['nom'];
                    }
                    if (isset($_POST['prenom'])){
                        $prenom=$_POST['prenom'];
                    }

                    if (isset($_GET['id'])){
                        $id=$_GET['id'];
                    }


                    if (isset($_POST['heritier'])) {
                        $results = $cnx->query("SELECT COUNT(p.id_proprietaire) AS nombre FROM projetp2.proprietaire p WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom';");
                        echo "SELECT COUNT(p.id_proprietaire) AS nombre FROM projetp2.proprietaire p WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom'; <br/>";
                        while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                            if(($ligne->nombre) >= 1){
                                $results2 = $cnx->query("SELECT p.id_proprietaire FROM projetp2.proprietaire p WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom';");
                                echo "SELECT p.id_proprietaire FROM projetp2.proprietaire p WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom';";
                                while( $ligne2 = $results2->fetch(PDO::FETCH_OBJ) ) {
                                    $results3 = $cnx->query("SELECT ep.id_proprietaire FROM projetp2.est_proprietaire ep WHERE ep.idconcession='$id';");
                                    echo "SELECT ep.id_proprietaire FROM projetp2.est_proprietaire ep WHERE ep.idconcession='$id';";
                                    while( $ligne3 = $results3->fetch(PDO::FETCH_OBJ) ) {
                                        $req4 = "INSERT INTO projetp2.heriter VALUES('$ligne3->id_proprietaire','$ligne2->id_proprietaire');";
                                        echo "$req4 <br/>";
                                        $cnx -> query($req4);
                                    }
                                }
                            }
                        }
                     
                    } elseif (isset($_POST['occupant'])) {
                     
                        $results = $cnx->query("SELECT COUNT(o.num_occupant) AS nombre FROM projetp2.occupant o WHERE o.nom_occupant='$nom' AND o.prenom_occupant='$prenom';");
                        //echo "SELECT COUNT(o.num_occupant) AS nombre FROM projetp2.occupant o WHERE o.nom_occupant='$nom' AND o.prenom_occupant='$prenom'; <br/>";
                        while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                            if(($ligne->nombre) >= 1){
                                $results2 = $cnx->query("SELECT o.num_occupant FROM projetp2.occupant o WHERE o.nom_occupant='$nom' AND o.prenom_occupant='$prenom';");
                                //echo "SELECT o.num_occupant FROM projetp2.occupant o WHERE o.nom_occupant='$nom' AND o.prenom_occupant='$prenom'; <br/>";
                                while( $ligne2 = $results2->fetch(PDO::FETCH_OBJ) ) {
                                    $req3 = "INSERT INTO projetp2.autoriser VALUES('$id','$ligne2->num_occupant');";
                                    //echo "$req3 <br/>";
                                    $cnx -> query($req3);
                                }
                            }
                        }
                     
                    }
                    //header("location: concessionsDetails.php?id=$id");
                ?>


                </div>
            </div>
        </div>
        <div class="footer2">         </div> 
    </body>  
</html>