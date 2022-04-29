<!DOCTYPE html>
<html>
    <head>  
        <link rel="stylesheet" href="style.css">
        <title>Cimetière</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head> 
     
    <body>
    <?php
        session_start();
        include("connexion.inc.php");
        if (isset($_POST['nom']) && isset($_POST['prenom'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mdp = $_POST['mdp'];
            $mdp = md5($mdp);
            $results = $cnx->query("SELECT COUNT(prenom_proprietaire) AS nombre FROM projetp2.proprietaire WHERE nom_proprietaire='$nom' AND prenom_proprietaire='$prenom';");
            //echo "SELECT COUNT(prenom_proprietaire) AS nombre FROM projetp2.proprietaire WHERE nom_proprietaire='$nom' AND prenom_proprietaire='$prenom';";
            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                if(($ligne->nombre) == 0){
                    $req2 = "INSERT INTO projetp2.proprietaire VALUES (default,'$nom','$prenom') RETURNING id_proprietaire ;";
                    //echo "$req2 <br/>";
                    if($results2 = $cnx -> query($req2)){
                        $id_pro = ($results2->fetch(PDO::FETCH_OBJ))->id_proprietaire;
                        //echo "$id_pro <br/>";
                        
                        $req3 = "INSERT INTO projetp2.authentification VALUES('$id_pro','$mdp');";
                        $cnx -> query($req3);
                        //echo "<br/>$req3";
                    header('location: login.php');
                    }   
                }else{
                    header('location: login.php');
                }            
                
            }
        }else{
            header('location: login.php');
        }
    ?>

</body>
</html>